<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Bottle','image'=>'bottle.png'],
            ['name' => 'Glass','image'=>'Ceramic_Mug.png'],
            ['name' => 'Metal','image'=>'mental_cate.png'],
            ['name' => 'Plastic','image'=>'plastic.png'],
            ['name' => 'Paper','image'=>'magazine.png'],
            ['name' => 'Electronic','image'=>'electron​ic.png'],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
