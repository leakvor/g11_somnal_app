<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Luhn;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cardName' => 'required|string|max:255',
            'cardNumber' => ['required', 'string', new Luhn],
            'cvv' => 'required|integer',
            'expiration_date' => 'required|string|size:5',
            'user_id' => 'required|exists:users,id', // Ensure user_id exists in users table
        ];
    }
}
