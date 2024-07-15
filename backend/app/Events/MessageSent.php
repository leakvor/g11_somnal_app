<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->chat->receiver_id);
    }

    public function broadcastWith()
    {
        // return [
        //     'id' => $this->chat->id,
        //     'user_id' => $this->chat->user_id,
        //     'user_name' => $this->chat->user->name,
        //     'receiver_id' => $this->chat->reciever_id,
        //     'receiver_name' => $this->chat->reciever->name,
        //     'message' => $this->chat->message,
        //     'image' => $this->chat->image,
        //     'created_at' => $this->chat->created_at->toDateTimeString(),
        // ];
        return ['message' => $this->chat];
    }
}
