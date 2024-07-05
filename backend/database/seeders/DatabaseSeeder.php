<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(2)->create();
        \App\Models\Item::factory(5)->create();
        $this->call(AdminSeeder::class);
        // \App\Models\Post::factory(17)->create();
        $this->call(MailsettingSeeder::class);
    }
}
