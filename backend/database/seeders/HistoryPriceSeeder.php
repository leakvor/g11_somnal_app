<?php

namespace Database\Seeders;

use App\Models\HistoryMarketPrice;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class HistoryPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = Item::all();
        $historyPrices = [];

        foreach ($items as $item) {
            for ($i = 1; $i <= 1; $i++) {
                $historyPrices[] = [
                    'old_price' => rand(1000, 10000),
                    'adjay_id' => $item->id,
                    'date' => Carbon::now()->subDays(rand(1, 365))->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        foreach ($historyPrices as $historyPrice) {
            HistoryMarketPrice::create($historyPrice);
        }
    }
}
