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
    public $user;
    public $receiver;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }

    public function broadcastWith()
    {
        $message = [
            'id' => $this->chat->id,
            'user_id' => $this->chat->user_id,
            'userName' => $this->chat->user->name,
            'userProfile' => $this->chat->user->profile,
            'receiver_id' => $this->chat->reciever_id,
            'receiverName' => $this->chat->reciever->name,
            'receiverProfile' => $this->chat->reciever->profile,
            'message' => $this->chat->message,
            'image' => $this->chat->image,
            'created_at' => $this->chat->created_at->toDateTimeString(),
        ];
        return ['message' => $message];
    }

    public function broadcastAs(){
        return 'MessageSent';
    }
}
