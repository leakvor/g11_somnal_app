<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'First Cambodia', 'email' => 'john@gmail.com','profile'=>'First_Cambodia.jpeg', 'password' => bcrypt('12345678'), 'phone' => '096 793 1800', 'role_id' => 3, 'address' => 'No. 123, Street 456, Khan Toul Kork, Phnom Penh, Cambodia', 'latitude' => 11.573093, 'longitude' => 104.898619],
            ['name' => 'Scrap Solution', 'email' => 'tiv@gmail.com', 'profile'=>'user_info.png','password' => bcrypt('12345678'), 'phone' => '097 793 1800', 'role_id' => 2, 'address' => 'No. 789, Street 321, Khan Daun Penh, Phnom Penh, Cambodia', 'latitude' => 11.569586, 'longitude' => 104.927868],
            ['name' => 'Adjay Finder', 'email' => 'voath@gmail.com','profile'=>'Adjay Finder.jpeg', 'password' => bcrypt('12345678'), 'phone' => '097 793 1800', 'role_id' => 3, 'address' => 'No. 456, Street 789, Khan Chamkar Mon, Phnom Penh, Cambodia', 'latitude' => 11.558375, 'longitude' => 104.921136],
            ['name' => 'Adjay Cambodia', 'email' => 'nha@gmail.com','profile'=>'user_info.png', 'password' => bcrypt('12345678'), 'phone' => '098 793 180', 'role_id' => 2, 'address' => 'No. 654, Street 987, Khan Sen Sok, Phnom Penh, Cambodia', 'latitude' => 11.578409, 'longitude' => 104.866211],
            ['name' => 'Somnal Alot', 'email' => 'thary@gmail.com','profile'=>'Somnal Alot.jpeg', 'password' => bcrypt('12345678'), 'phone' => '093 793 1801', 'role_id' => 3, 'address' => 'No. 98, Street 278, Khan Chamkar Mon, Phnom Penh, Cambodia', 'latitude' => 11.551654, 'longitude' => 104.923287],
            ['name' => 'Help Cambodia', 'email' => 'nich@gmail.com','profile'=>'Help Cambodia.jpeg', 'password' => bcrypt('12345678'), 'phone' => '093 793 1802', 'role_id' => 2, 'address' => 'No. 456, Street 63, Khan Daun Penh, Phnom Penh, Cambodia', 'latitude' => 11.567829, 'longitude' => 104.928474],
            ['name' => 'Cambdia No Scrap', 'email' => 'vy@gmail.com','profile'=>'Cambdia No Scrap.jpeg', 'password' => bcrypt('12345678'), 'phone' => '094 793 802', 'role_id' => 3, 'address' => 'No. 789, Street 169, Khan 7 Makara, Phnom Penh, Cambodia', 'latitude' => 11.563847, 'longitude' => 104.912345],
            ['name' => 'Khmer Kmean Somram', 'email' => 'na@gmail.com','profile'=>'Khmer Kmean Somram.jpg', 'password' => bcrypt('12345678'), 'phone' => '094 793 901', 'role_id' => 3, 'address' => 'No. 321, Street 242, Khan Toul Kork, Phnom Penh, Cambodia', 'latitude' => 11.574001, 'longitude' => 104.899999],
            ['name' => 'Somnal Cambodia', 'email' => 'tem@gmail.com', 'profile'=>'user_info.png','password' => bcrypt('12345678'), 'phone' => '097 793 701', 'role_id' => 2, 'address' => 'No. 654, Street 2004, Khan Sen Sok, Phnom Penh, Cambodia', 'latitude' => 11.577654, 'longitude' => 104.865321],
            ['name' => 'Chay Luk ng Tinh Adjay', 'email' => 'chhay@gmail.com','profile'=>'Scrap_Solution.jpeg', 'password' => bcrypt('12345678'), 'phone' => '095 793 1800', 'role_id' => 3, 'address' => 'No. 432, Street 211, Khan Tuol Kork, Phnom Penh, Cambodia', 'latitude' => 11.573500, 'longitude' => 104.898300],
            ['name' => 'Kosal Adjay', 'email' => 'kosal@gmail.com','profile'=>'user_info.png', 'password' => bcrypt('12345678'), 'phone' => '095 793 1801', 'role_id' => 2, 'address' => 'No. 765, Street 56, Khan Mean Chey, Phnom Penh, Cambodia', 'latitude' => 11.568000, 'longitude' => 104.900000],
            ['name' => 'Cambodia no Ajay', 'email' => 'rith@gmail.com','profile'=>'Adjay Cambodia.jpeg', 'password' => bcrypt('12345678'), 'phone' => '092 793 1800', 'role_id' => 3, 'address' => 'No. 123, Street 789, Khan Sen Sok, Phnom Penh, Cambodia', 'latitude' => 11.579000, 'longitude' => 104.868000],
            ['name' => 'Scrap in Cambodia', 'email' => 'sophea@gmail.com','profile'=>'user_info.png', 'password' => bcrypt('12345678'), 'phone' => '096 793 1801', 'role_id' => 2, 'address' => 'No. 234, Street 987, Khan Chamkar Mon, Phnom Penh, Cambodia', 'latitude' => 11.552000, 'longitude' => 104.920000],
            ['name' => 'Adjay In Cambodia', 'email' => 'bun@gmail.com','profile'=>'Adjay In Cambodia.webp', 'password' => bcrypt('12345678'), 'phone' => '097 793 1801', 'role_id' => 3, 'address' => 'No. 567, Street 123, Khan 7 Makara, Phnom Penh, Cambodia', 'latitude' => 11.564000, 'longitude' => 104.913000],
            ['name' => 'Tinh THinh Adjay', 'email' => 'seyha@gmail.com','profile'=>'user_info.png', 'password' => bcrypt('12345678'), 'phone' => '098 793 1801', 'role_id' => 2, 'address' => 'No. 890, Street 456, Khan Russey Keo, Phnom Penh, Cambodia', 'latitude' => 11.555000, 'longitude' => 104.850000],
            ['name' => 'Tinh Adjay', 'email' => 'dara@gmail.com','profile'=>'Tinh Adjay.jpeg', 'password' => bcrypt('12345678'), 'phone' => '099 793 1800', 'role_id' => 3, 'address' => 'No. 321, Street 654, Khan Toul Kork, Phnom Penh, Cambodia', 'latitude' => 11.575000, 'longitude' => 104.900000],
            ['name' => 'Ravy Somart Adjay', 'email' => 'ravy@gmail.com','profile'=>'user_info.png', 'password' => bcrypt('12345678'), 'phone' => '091 793 1800', 'role_id' => 2, 'address' => 'No. 654, Street 123, Khan Chamkar Mon, Phnom Penh, Cambodia', 'latitude' => 11.553000, 'longitude' => 104.922000],
            ['name' => 'Clean Adjay', 'email' => 'sok@gmail.com', 'profile'=>'Clean Adjay.jpeg','password' => bcrypt('12345678'), 'phone' => '092 793 1801', 'role_id' => 3, 'address' => 'No. 789, Street 987, Khan Daun Penh, Phnom Penh, Cambodia', 'latitude' => 11.570000, 'longitude' => 104.930000],
            ['name' => 'Adjay Smos Sne', 'email' => 'veasna@gmail.com', 'profile'=>'user_info.png','password' => bcrypt('12345678'), 'phone' => '093 793 1803', 'role_id' => 2, 'address' => 'No. 111, Street 222, Khan Mean Chey, Phnom Penh, Cambodia', 'latitude' => 11.566000, 'longitude' => 104.910000]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
    }

