<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'notification' => $this->notification,
            'post_id' => $this->post_id,
            'company_id' => $this->company_id,
            'status' => $this->status,
            'post' => $this->post,
            'company' => $this->company,
        ];
    }
}
