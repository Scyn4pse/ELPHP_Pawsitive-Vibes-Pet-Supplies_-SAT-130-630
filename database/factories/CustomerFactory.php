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
            'cust_name' => $this->faker->name,
            'cust_email' => $this->faker->unique()->safeEmail,
            'cust_password' => bcrypt('password'), // hashed password
            'cust_phone' => $this->faker->unique()->phoneNumber,
            'cust_address' => $this->faker->address,
            'user_role' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
