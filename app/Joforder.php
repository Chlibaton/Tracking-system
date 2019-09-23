<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joforder extends Model
{
    protected $fillable = [
        'jofno','customer_name','kind_of_ring','date_prepared','due_date','jof_status',
    ];
    protected $primaryKey = 'id';
    protected $table = 'JOFORDER';
}
