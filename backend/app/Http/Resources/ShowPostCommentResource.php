<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPostCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'create' => $this->created_at->format('Y-m-d'),
            'user' => [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'profile'=>$this->user->profile
        ],
            'comment' => ShowCommentResource::collection($this->comment),
            'total_comments' => $this->comment->count(),
            'userLikes' => ShowLikeResource::collection($this->like),
            'total_likes' => $this->like->count(),
        ];
    }
}
