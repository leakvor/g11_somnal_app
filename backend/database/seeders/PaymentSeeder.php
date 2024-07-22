<?php

namespace Database\Seeders;

use App\Models\OptionPaid;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users with role_id == 2
        $users = User::where('role_id', 2)->get();
        $optionPaids = OptionPaid::all();


        $payments = [];

        foreach ($users as $index => $user) {
            // Use modulo to cycle through optionPaid records
            $optionPaidId = $optionPaids[$index % $optionPaids->count()]->id;
            
            $payments[] = [
                'cardName' => 'User ' . $user->name,
                'cardNumber' => str_repeat($index + 1, 16),
                'cvv' => '123',
                'expiration_date' => '12/25',
                'user_id' => $user->id,
                'option_paid_id' => $optionPaidId,
                'status' => (bool)($index % 2),
            ];
        }

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}

