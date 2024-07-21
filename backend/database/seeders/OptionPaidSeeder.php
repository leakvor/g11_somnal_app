<?php

namespace Database\Seeders;

use App\Models\OptionPaid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionPaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $optionPaids = [
            ['option_paid' => 'Free', 'amount' => 0, 'description' => 'Free 30 days for all of you first join with us. Give the trust and high quality if you choose our app for use.', 'type' => 'Free'],
            ['option_paid' => '1 month', 'amount' => 10, 'description' => 'In this case you need to pay $10 a month If you do not pay on time or 3 days after the deadline, we will cut money from you and disable your account.', 'type' => 'Start'],
            ['option_paid' => '6 months', 'amount' => 55, 'description' => 'In this case, you need to pay $55 for half a year. You will get a $5 profit. But if you do not pay on time, we will cut money from you and disable your account automatically.', 'type' => 'Standard'],
            ['option_paid' => '1 year', 'amount' => 90, 'description' => 'For this one, if you pay $100/year, you will get a $10 profit. It is very good for you. But if you do not pay on time, we will penalize you with $15 and disable your account automatically.', 'type' => 'Premuim'],
        ];

        foreach ($optionPaids as $optionPaid) {
            OptionPaid::create($optionPaid);
        }
    }
}
