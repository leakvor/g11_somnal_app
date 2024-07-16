<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phnomPenhAddresses = [
            [
                'address' => 'No. 123, Street 456, Khan Toul Kork, Phnom Penh, Cambodia',
                'latitude' => 11.573093,
                'longitude' => 104.898619
            ],
            [
                'address' => 'No. 789, Street 321, Khan Daun Penh, Phnom Penh, Cambodia',
                'latitude' => 11.569586,
                'longitude' => 104.927868
            ],
            [
                'address' => 'No. 456, Street 789, Khan Chamkar Mon, Phnom Penh, Cambodia',
                'latitude' => 11.558375,
                'longitude' => 104.921136
            ],
            [
                'address' => 'No. 321, Street 654, Khan 7 Makara, Phnom Penh, Cambodia',
                'latitude' => 11.562108,
                'longitude' => 104.914848
            ],
            [
                'address' => 'No. 654, Street 987, Khan Sen Sok, Phnom Penh, Cambodia',
                'latitude' => 11.578409,
                'longitude' => 104.866211
            ],
            [
                'address' => 'No. 98, Street 278, Khan Chamkar Mon, Phnom Penh, Cambodia',
                'latitude' => 11.551654,
                'longitude' => 104.923287
            ],
            [
                'address' => 'No. 456, Street 63, Khan Daun Penh, Phnom Penh, Cambodia',
                'latitude' => 11.567829,
                'longitude' => 104.928474
            ],
            [
                'address' => 'No. 789, Street 169, Khan 7 Makara, Phnom Penh, Cambodia',
                'latitude' => 11.563847,
                'longitude' => 104.912345
            ],
            [
                'address' => 'No. 321, Street 242, Khan Toul Kork, Phnom Penh, Cambodia',
                'latitude' => 11.574001,
                'longitude' => 104.899999
            ],
            [
                'address' => 'No. 654, Street 2004, Khan Sen Sok, Phnom Penh, Cambodia',
                'latitude' => 11.577654,
                'longitude' => 104.865321
            ]
        ];

        $addressData = $this->faker->randomElement($phnomPenhAddresses);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // or use the hash directly if preferred
            'remember_token' => Str::random(10),
            'phone' => $this->faker->numerify('09#########'), 
            'role_id' => $this->faker->randomElement([2, 3]),
            'address' => $addressData['address'],
            'latitude' => $addressData['latitude'],
            'longitude' => $addressData['longitude'],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
