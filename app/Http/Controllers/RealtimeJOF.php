<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class RealtimeJOF extends Controller implements ShouldBroadcast
{
    public function broadcastOn()
        {
            return new PrivateChannel('order.'.$this->update->order_id);
        }
    
}
