<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->user;
        $receiver = $this->receiver;
        
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'userName' => $user ? $user->name : '',
            'receiver_id' => $this->receiver_id,
            'receiverName' => $receiver ? $receiver->name : '',
            'message' => $this->message ?? '',
            'image' => $this->image,
            'userProfile' => $user ? $user->profile : '',
            'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : '',
            'created_at_formatted' => $this->created_at ? $this->created_at->format('g:i A') : '',
        ];
    }
}
