<?php

namespace Database\Seeders;

use App\Models\Post_Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $post_items=[
            ['item_id'=>1,'post_id'=>1],
            ['item_id'=>2,'post_id'=>1],
            ['item_id'=>3,'post_id'=>1],
            ['item_id'=>4,'post_id'=>2],
            ['item_id'=>5,'post_id'=>2],
            ['item_id'=>6,'post_id'=>3],
            ['item_id'=>7,'post_id'=>3],
            ['item_id'=>8,'post_id'=>4],
            ['item_id'=>9,'post_id'=>5],
            ['item_id'=>10,'post_id'=>5],
            ['item_id'=>11,'post_id'=>5],
            ['item_id'=>12,'post_id'=>7],
            ['item_id'=>13,'post_id'=>8],
            ['item_id'=>14,'post_id'=>9],
            ['item_id'=>15,'post_id'=>10],
            ['item_id'=>16,'post_id'=>10],
            ['item_id'=>1,'post_id'=>10],
            ['item_id'=>17,'post_id'=>11],
            ['item_id'=>18,'post_id'=>11],
            ['item_id'=>19,'post_id'=>11],
            ['item_id'=>20,'post_id'=>12],
            ['item_id'=>21,'post_id'=>13],
            ['item_id'=>13,'post_id'=>14],
            ['item_id'=>15,'post_id'=>15],
            ['item_id'=>9,'post_id'=>16],
            ['item_id'=>5,'post_id'=>16],
            ['item_id'=>12,'post_id'=>17],
            ['item_id'=>7,'post_id'=>18],
            ['item_id'=>8,'post_id'=>19],
            ['item_id'=>18,'post_id'=>19],
            ['item_id'=>6,'post_id'=>20],
            ['item_id'=>14,'post_id'=>21],
            ['item_id'=>14,'post_id'=>21],
            ['item_id'=>18,'post_id'=>22],
        ];
        foreach($post_items as $post_item){
            Post_Item::create($post_item);
        }
    }
}
