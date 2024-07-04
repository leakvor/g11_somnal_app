<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class Luhn implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove any non-numeric characters from the value
        $value = preg_replace('/[^0-9]/', '', $value);

        // Check if the value is empty or does not have exactly 16 digits
        if (empty($value) || strlen($value) !== 16 || !is_numeric($value)) {
            return false;
        }

        // Validate using the Luhn algorithm
        $sum = 0;
        $numDigits = strlen($value);
        $parity = $numDigits % 2;

        for ($i = 0; $i < $numDigits; $i++) {
            $digit = intval($value[$i]);

            if ($i % 2 === $parity) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return $sum % 10 === 0;
    }

    public function message()
    {
        return 'Invalid card number';
    }
}
