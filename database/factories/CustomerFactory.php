<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cust_name' => $this->faker->unique()->name,
            'cust_password' => bcrypt('password'), // hashed password
            'cust_phone' => $this->faker->unique()->phoneNumber,
            'cust_address' => $this->faker->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
