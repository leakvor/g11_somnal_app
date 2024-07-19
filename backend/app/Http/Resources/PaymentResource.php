<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'cardName' => $this->cardName,
            'cardNumber' => $this->cardNumber,
            'cvv' => $this->cvv,
            'expiration_date' => $this->expiration_date,
            'user' => $this->user,
            'status'=>$this->status,
            'option_paid'=>new OptionPayResource($this->optionPaid),
        ];
    }
}
