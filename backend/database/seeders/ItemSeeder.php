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
            // can
            ['name' => 'Can', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '2000', 'description' => "it is the type of item that we accept to buy.", 'image' => 'can.png'],
            ['name' => 'Milk cans', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '2000', 'description' => "it is the type of item that we accept to buy.", 'image' => 'milkcan.jpg'],
            ['name' => 'Can fruit', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '2000', 'description' => "it is the type of item that we accept to buy.", 'image' => 'canfruit.jpg'],
            // bottle
            ['name' => 'Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id, 'price' => '1000', 'description' => "it is the type of item that we accept to buy.", 'image' => 'bottle.png'],
            ['name' => 'Glass Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id, 'price' => '300', 'description' => "it is the type of item that we accept to buy.", 'image' => 'stonebottle.png'],
            ['name' => 'Ingredients Bottle', 'category_id' => $categories->where('name', 'Bottle')->first()->id, 'price' => '200', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Plastic_bottles.png'],
            // metal
            ['name' => 'Metal Sheet', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '200', 'description' => "it is the type of item that we accept to buy.", 'image' => 'metalsheet.png'],
            ['name' => 'TMT Bars', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '300', 'description' => "it is the type of item that we accept to buy.", 'image' => 'TMT_Bars.jpg'],
            ['name' => 'Spring', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '500', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Springs.jpg'],
            ['name' => 'Chains', 'category_id' => $categories->where('name', 'Metal')->first()->id, 'price' => '500', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Chains.jpg'],
            // plastic
            ['name' => 'Shoes', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '200', 'description' => "it is the type of item that we accept to buy.", 'image' => 'shoes.png'],
            ['name' => 'Clean', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'clean.png'],
            ['name' => 'Tires', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '100', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Tires.png'],
            ['name' => 'Plastic Bag', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '150', 'description' => "it is the type of item that we accept to buy.", 'image' => 'plastic.png'],
            ['name' => 'Bottle Cap', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '200', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Bottle_cap.png'],
            ['name' => 'Cleaning Hacks', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '150', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Cleaning_Hacks.png'],
            ['name' => 'Plastic Straws', 'category_id' => $categories->where('name', 'Plastic')->first()->id, 'price' => '150', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Plastic_Straws.png'],
            // paper
            ['name' => 'NoteBook', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '200', 'description' => "it is the type of item that we accept to buy.", 'image' => 'notebook.png'],
            ['name' => 'Paper Color', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '100', 'description' => "it is the type of item that we accept to buy.", 'image' => 'papercolor.jpg'],
            ['name' => 'cutpaper', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '300', 'description' => "it is the type of item that we accept to buy.", 'image' => 'cutpaper.png'],
            ['name' => 'Book', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '100', 'description' => "it is the type of item that we accept to buy.", 'image' => 'createrMagazine.png'],
            ['name' => 'Magazine News', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '100', 'description' => "it is the type of item that we accept to buy.", 'image' => 'magazineNew.png'],
            ['name' => 'File Document', 'category_id' => $categories->where('name', 'Paper')->first()->id, 'price' => '100', 'description' => "it is the type of item that we accept to buy.", 'image' => 'fileDocument.jpg'],
            // glass
            ['name' => 'Tea Cup', 'category_id' => $categories->where('name', 'Glass')->first()->id, 'price' => '3400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'tea-cup.png'],
            ['name' => 'Vacuum Cup', 'category_id' => $categories->where('name', 'Glass')->first()->id, 'price' => '3400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'VacuumCup.jpg'],
            // electronic

            ['name' => 'Projector', 'category_id' => $categories->where('name', 'Electronic')->first()->id, 'price' => '3400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'projector.png'],
            ['name' => 'Power Cord', 'category_id' => $categories->where('name', 'Electronic')->first()->id, 'price' => '340', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Power_cord.png'],
            ['name' => 'Keyboard', 'category_id' => $categories->where('name', 'Electronic')->first()->id, 'price' => '400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'keyboard.png'],
            ['name' => 'Electronic House', 'category_id' => $categories->where('name', 'Electronic')->first()->id, 'price' => '400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'home_electronic.png'],
            ['name' => 'Aircon Compressors', 'category_id' => $categories->where('name', 'Electronic')->first()->id, 'price' => '400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Aircon_Compressors.png'],
            ['name' => 'Air conditioning', 'category_id' => $categories->where('name', 'Electronic')->first()->id, 'price' => '400', 'description' => "it is the type of item that we accept to buy.", 'image' => 'Air_conditioning.png'],
        ];
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
