<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\Post_Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images=Image::all();
        $posts=Post::all();
        $post_images=[
            ['image_id'=>1,'post_id'=>1],
            ['image_id'=>2,'post_id'=>1],
            ['image_id'=>3,'post_id'=>1],
            ['image_id'=>4,'post_id'=>2],
            ['image_id'=>5,'post_id'=>2],
            ['image_id'=>6,'post_id'=>3],
            ['image_id'=>7,'post_id'=>3],
            ['image_id'=>8,'post_id'=>4],
            ['image_id'=>9,'post_id'=>5],
            ['image_id'=>10,'post_id'=>5],
            ['image_id'=>11,'post_id'=>5],
            ['image_id'=>12,'post_id'=>7],
            ['image_id'=>13,'post_id'=>8],
            ['image_id'=>14,'post_id'=>9],
            ['image_id'=>15,'post_id'=>10],
            ['image_id'=>16,'post_id'=>10],
            ['image_id'=>1,'post_id'=>10],
            ['image_id'=>17,'post_id'=>11],
            ['image_id'=>18,'post_id'=>23],
            ['image_id'=>19,'post_id'=>11],
            ['image_id'=>20,'post_id'=>12],
            ['image_id'=>21,'post_id'=>13],
            ['image_id'=>13,'post_id'=>14],
            ['image_id'=>15,'post_id'=>15],
            ['image_id'=>9,'post_id'=>16],
            ['image_id'=>5,'post_id'=>16],
            ['image_id'=>12,'post_id'=>17],
            ['image_id'=>7,'post_id'=>18],
            ['image_id'=>8,'post_id'=>19],
            ['image_id'=>18,'post_id'=>19],
            ['image_id'=>6,'post_id'=>20],
            ['image_id'=>14,'post_id'=>21],
            ['image_id'=>5,'post_id'=>22],
        ];
        foreach($post_images as $post_image){
            Post_Image::create($post_image);
        }
    }
}
