<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            ['title' => 'I want to sell my bottle.', 'user_id' => 1, 'company_id' => 2, 'status' => 'pending'],
            ['title' => 'I want to sell my scrap.', 'user_id' => 4, 'company_id' => 4, 'status' => 'pending'],
            ['title' => 'I have a lot of scrap to sell.', 'user_id' => 5, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of cans to sell.', 'user_id' => 6, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of computers.', 'user_id' => 7, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I want to sell my phone.', 'user_id' => 1, 'company_id' => 2, 'status' => 'pending'],
            ['title' => 'I want to sell my TV.', 'user_id' => 4, 'company_id' => 4, 'status' => 'pending'],
            ['title' => 'I have a lot of books to sell.', 'user_id' => 5, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of furniture to sell.', 'user_id' => 6, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of clothes to sell.', 'user_id' => 7, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I want to sell my bike.', 'user_id' => 1, 'company_id' => 2, 'status' => 'pending'],
            ['title' => 'I want to sell my car.', 'user_id' => 4, 'company_id' => 4, 'status' => 'pending'],
            ['title' => 'I have a lot of shoes to sell.', 'user_id' => 5, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of bags to sell.', 'user_id' => 6, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of accessories to sell.', 'user_id' => 7, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I want to sell my laptop.', 'user_id' => 1, 'company_id' => 2, 'status' => 'pending'],
            ['title' => 'I want to sell my tablet.', 'user_id' => 4, 'company_id' => 4, 'status' => 'pending'],
            ['title' => 'I have a lot of tools to sell.', 'user_id' => 5, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of toys to sell.', 'user_id' => 6, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of kitchenware to sell.', 'user_id' => 7, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of my old scraps', 'user_id' => 3, 'company_id' => null, 'status' => 'pending'],
            ['title' => 'I have a lot of my old bottle', 'user_id' => 8, 'company_id' => null, 'status' => 'pending'],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
