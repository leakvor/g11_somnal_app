<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $items = [
            ['name' => 'Coke Can', 'category_id' => $categories->where('name', 'Can')->first()->id, 'price' => '2000', 'image' => 'coke_can.jpg'],
            ['name' => 'Pepsi Can', 'category_id' => $categories->where('name', 'Can')->first()->id, 'price' => '2000', 'image' => 'pepsi_can.jpg'],
            ['name' => 'Water Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id, 'price' => '1200', 'image' => 'water_bottle.jpg'],
            ['name' => 'Juice Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id, 'price' => '1600', 'image' => 'juice_bottle.jpg'],
            ['name' => 'Glass Cup', 'category_id' => $categories->where('name', 'Glass')->first()->id, 'price' => '800', 'image' => 'glass_cup.jpg'],
            ['name' => 'Wine Glass', 'category_id' => $categories->where('name', 'Glass')->first()->id, 'price' => '3200', 'image' => 'wine_glass.jpg'],
            ['name' => 'Steel Rod', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '4000', 'image' => 'steel_rod.jpg'],
            ['name' => 'Aluminum Foil', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '2800', 'image' => 'aluminum_foil.jpg'],
            ['name' => 'Plastic Bag', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '200', 'image' => 'plastic_bag.jpg'],
            ['name' => 'Plastic Bottle', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '400', 'image' => 'plastic_bottle.jpg'],
            ['name' => 'Notebook', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '600', 'image' => 'notebook.jpg'],
            ['name' => 'Newspaper', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '200', 'image' => 'newspaper.jpg'],
            ['name' => 'Soda Can', 'category_id' => $categories->where('name', 'Can')->first()->id, 'price' => '2000', 'image' => 'soda_can.jpg'],
            ['name' => 'Energy Drink Can', 'category_id' => $categories->where('name', 'Can')->first()->id, 'price' => '2400', 'image' => 'energy_drink_can.jpg'],
            ['name' => 'Sparkling Water Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id, 'price' => '1400', 'image' => 'sparkling_water_bottle.jpg'],
            ['name' => 'Sports Drink Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id, 'price' => '2000', 'image' => 'sports_drink_bottle.jpg'],
            ['name' => 'Glass Bottle', 'category_id' => $categories->where('name', 'Glass')->first()->id, 'price' => '3000', 'image' => 'glass_bottle.jpg'],
            ['name' => 'Ceramic Mug', 'category_id' => $categories->where('name', 'Glass')->first()->id, 'price' => '3400', 'image' => 'ceramic_mug.jpg'],
            ['name' => 'Copper Wire', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '4800', 'image' => 'copper_wire.jpg'],
            ['name' => 'Iron Sheet', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '3600', 'image' => 'iron_sheet.jpg'],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
