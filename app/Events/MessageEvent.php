<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    //Nome do evento
    public function broadcastAs()
    {
        return 'message-event';
    }

    //Canal
    public function broadcastOn()
    {
        return ['message-channel'];
    }

    //Mensagem do Canal
    public function broadcastWith()
    {
        return ['dados' => $this->data];
    }
}
