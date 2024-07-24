<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray( $request): array
    {
        return [
            'id' => $this->id,
            'cardName' => $this->cardName,
            'cardNumber' => $this->cardNumber,
            'cvv' => $this->cvv,
            'expiration_date' => $this->expiration_date,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d'),
            'user' => $this->user,
            'option_paid' => new OptionPayResource($this->optionPaid),
            'deadline' => $this->calculateDeadline($this->optionPaid->option_paid, $this->created_at),
        ];
    }

    /**
     * Calculate the deadline based on the option paid and creation date.
     *
     * @param  string  $optionPaid
     * @param  string  $createdAt
     * @return string
     */
    private function calculateDeadline($optionPaid, $createdAt): string
    {
        $creationDate = Carbon::parse($createdAt);

        switch ($optionPaid) {
            case 'Free':
                return $creationDate->addDays(30)->format('Y-m-d');
            case '1 month':
                return $creationDate->addMonth()->format('Y-m-d');
            case '6 months':
                return $creationDate->addMonths(6)->format('Y-m-d');
            case '1 year':
                return $creationDate->addYear()->format('Y-m-d');
            default:
                return $creationDate->format('Y-m-d');
        }
    }
}
