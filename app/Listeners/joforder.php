<?php

namespace App\Listeners;

use App\Events\JOFStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class joforder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  JOFStatus  $event
     * @return void
     */
    public function handle(JOFStatus $event)
    {
        return $event;
    }
}
