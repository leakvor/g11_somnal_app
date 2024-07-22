<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ['image'=>'blue_u.jpg'],
            ['image'=>'boom.jpg'],
            ['image'=>'bootle_u.jpg'],
            ['image'=>'bootled_u.jpg'],
            ['image'=>'computer_hardward_u.webp'],
            ['image'=>'control_u.jpg'],
            ['image'=>'dek_u.jpg'],
            ['image'=>'electroni_u.jpg'],
            ['image'=>'Electronics_u.jpg'],
            ['image'=>'fire_u.jpg'],
            ['image'=>'firs_u.jpg'],
            ['image'=>'home_u.jpg'],
            ['image'=>'keyboard_u.jpg'],
            ['image'=>'lamp_u.jpg'],
            ['image'=>'monitor_u.jpg'],
            ['image'=>'mouse_id.jpg'],
            ['image'=>'old_fire_u.jpg'],
            ['image'=>'old_tv.jpg'],
            ['image'=>'ram_id.jpg'],
            ['image'=>'screen_u.jpg'],
            ['image'=>'simple_bottle.jpg'],
            ['image'=>'tv_u.jpg'],
        ];
        foreach ($images as $image) {
            Image::create($image);
        }
    }

}
