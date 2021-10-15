<?php

namespace App\Events;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendGlobalNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
   // protected $user;
   // protected $message;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        // $this->user = $user;
        // $this->message = $message;
        $this->message = $msg;
    }

    public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        // return [
            // 'user' => $this->user->name,
            // 'message' => $this->message,
        // ];
    }

    public function broadcastAs()
    {
      //  return 'newMessage';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return ['global-notif'];
        // return new Channel('messages');
    }
}
