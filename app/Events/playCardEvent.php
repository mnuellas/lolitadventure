<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class playCardEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $room;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $room)
    {
        $this->room = $room;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('room.' . $this->room['room']);
    }
    public function broadCastWith()
    {
        $toReturn = [
            'card' => $this->room["card"],
            'type' => $this->room["type"]
        ];
        if ($this->room["type"] == "Quizz") {
            $toReturn['whereGoodAnswerIs'] = $this->room["whereGoodAnswerIs"];
        }
        return $toReturn;
    }
}
