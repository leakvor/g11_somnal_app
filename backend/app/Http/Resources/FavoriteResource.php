<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'user_id' => $this->user_id,
            'item' => [
                'id' => $this->item->id,
                'name' => $this->item->name,
                'category' => new CateogryListResource($this->item->category),
                'price' => $this->item->price,
                'image' => $this->item->image,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
