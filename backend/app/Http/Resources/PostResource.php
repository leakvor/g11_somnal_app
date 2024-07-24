<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'profile' => $this->user->profile ? $this->user->profile : 'user_info.png', // Default to 'user_info.png' if profile is null
            ],
            'company_id' => $this->company_id,
            'images' => $this->images->map(function ($image) {
                return [
                    'image_id' => $image->image_id,
                    'image' => $image->image ? $image->image->image : null, 
                ];
            })->all(),
            'items' => $this->items->map(function ($item) {
                return [
                    'item_id' => $item->item_id,
                    'item' => $item->item ? $item->item->name : null, 
                    'price' => $item->item ? $item->item->price : null, 
                ];
            })->all(),
            'status' => $this->status,
            'date_created' => $this->created_at->format('d M Y H:i:s'),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
    
    
}

