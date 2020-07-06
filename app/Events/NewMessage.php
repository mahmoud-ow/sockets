<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use App\Message;
use App\User;


class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('messages.'. $this->message->to);
    }

    public function broadcastwith(){
        $user = User::find(2);
        $user->profile_image = ( $user->getMedia('avatar')->first() ) ? $user->getMedia('avatar')->first()->getUrl('thumb') : 'images/dashboard/profile-default-image.png' ;
        $this->message->from_contact = $user;
        return ['message' => $this->message];
    }
}
