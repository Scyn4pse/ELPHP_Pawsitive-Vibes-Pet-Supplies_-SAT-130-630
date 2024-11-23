<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seller_name' => $this->faker->unique()->name,
            'seller_password' => bcrypt('password'), // hashed password
            'seller_phone' => $this->faker->unique()->phoneNumber,
            'seller_store_name' => $this->faker->company,
            'user_role_id' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
