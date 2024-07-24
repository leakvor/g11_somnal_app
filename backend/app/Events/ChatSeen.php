<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\BroadcastEvent;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatSeen implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $userId;
    public $receiverId;
    public $unseenMessages;

    public function __construct($userId, $receiverId, $unseenMessages)
    {
        $this->userId = $userId;
        $this->receiverId = $receiverId;
        $this->unseenMessages = $unseenMessages;
    }

    public function broadcastOn()
    {
        return new Channel('totalUnseen' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'user_id' => $this->userId,
            'receiver_id' => $this->receiverId,
            'unseen_messages' => $this->unseenMessages
        ];
    }
    public function broadcastAs(){
        return 'totalUnseen';
    }
}
