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
            ['name' => 'Coke Can', 'category_id' => $categories->where('name', 'Can')->first()->id],
            ['name' => 'Pepsi Can', 'category_id' => $categories->where('name', 'Can')->first()->id],
            ['name' => 'Water Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id],
            ['name' => 'Juice Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id],
            ['name' => 'Glass Cup', 'category_id' => $categories->where('name', 'Glass')->first()->id],
            ['name' => 'Wine Glass', 'category_id' => $categories->where('name', 'Glass')->first()->id],
            ['name' => 'Steel Rod', 'category_id' => $categories->where('name', 'Metal')->first()->id],
            ['name' => 'Aluminum Foil', 'category_id' => $categories->where('name', 'Metal')->first()->id],
            ['name' => 'Plastic Bag', 'category_id' => $categories->where('name', 'Plastic')->first()->id],
            ['name' => 'Plastic Bottle', 'category_id' => $categories->where('name', 'Plastic')->first()->id],
            ['name' => 'Notebook', 'category_id' => $categories->where('name', 'Paper')->first()->id],
            ['name' => 'Newspaper', 'category_id' => $categories->where('name', 'Paper')->first()->id],
            ['name' => 'Soda Can', 'category_id' => $categories->where('name', 'Can')->first()->id],
            ['name' => 'Energy Drink Can', 'category_id' => $categories->where('name', 'Can')->first()->id],
            ['name' => 'Sparkling Water Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id],
            ['name' => 'Sports Drink Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id],
            ['name' => 'Glass Bottle', 'category_id' => $categories->where('name', 'Glass')->first()->id],
            ['name' => 'Ceramic Mug', 'category_id' => $categories->where('name', 'Glass')->first()->id],
            ['name' => 'Copper Wire', 'category_id' => $categories->where('name', 'Metal')->first()->id],
            ['name' => 'Iron Sheet', 'category_id' => $categories->where('name', 'Metal')->first()->id],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
