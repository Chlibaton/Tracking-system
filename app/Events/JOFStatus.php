<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Joforder;


class JOFStatus implements ShouldBroadcast

{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $joforder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($joforder)
    {
        $this->joforder = $joforder;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
  {
      return ['joforder'];
  }
  public function broadcastAs()
  {
      return 'my-event';
  }

}
