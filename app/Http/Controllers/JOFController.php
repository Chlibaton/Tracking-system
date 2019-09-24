<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\joforder;
use PDF;
use Carbon\Carbon;

class JOFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        switch($id){
            case 1:
                $status = "Receiving Section";
               break;
            case 2:
                $status = "Mold Section";
                break; 
            case 3:
                $status = "Plastic Section";
                break; 
            case 4:
                $status = "Wax Section";
                break; 
            case 5:
                $status = "Casting Section";
                break; 
            case 6:
                $status = "Salugar Section";
                break; 
            case 7:
                $status = "Stone Section";
                break; 
            case 8:
                $status = "Finishing Section";
                break; 
            case 10:
                $status = "For Releasing";
                break; 
           }
       
        $result = joforder::where('jof_status',$status)->orderBy('id','desc')->get()->all();
        return $result;
        
    }
    public function JOFstatus()
    { 
        $result = joforder::orderBy('due_date','asc')->get()->all();
        return $result;  
    }
    public function JOFPending()
    { 
        $result = joforder::where('jof_status','!=','Delivered')->orderBy('due_date','asc')->get()->all();
        return $result;  
    }
    public function JOFDelivered()
    { 
        $result = joforder::where('jof_status','Delivered')->orderBy('due_date','asc')->get()->all();
        return $result;  
    }
    public function ExportPDF($id){
        $joforder = joforder::where('date_prepared','>=',$id)->get()->all();
        $date = Carbon::now();
        $datesevendays = $date->addDays(7);
        $pdf = PDF::loadView('pdf', compact('joforder','datesevendays'));
         return $pdf->download('JOFOrder.pdf');
        // return view('pdf',['joforder'=>$joforder,'datesevendays'=>$datesevendays]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $result = joforder::create($request->all());
        return $result;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $result = joforder::where('id', $request->id)->update($request->all());
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = joforder::where('id',$id)->delete();
        return 'Deleted';
    }

    public function updateStatus(Request $request){
        joforder::where('id', $request->id)
            ->orderby('id', 'desc')
            ->take(1)
            ->update([
                'jof_status' =>$request->jof_status,
                ]);
        return 'success';
    }
}
