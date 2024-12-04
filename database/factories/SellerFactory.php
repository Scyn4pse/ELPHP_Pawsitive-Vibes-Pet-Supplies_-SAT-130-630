<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SellerFactory extends Factory
{

    public function definition(): array
    {
        return [
            'seller_name' => $this->faker->unique()->name,
            'seller_password' => bcrypt('password'), 
            'seller_phone' => $this->faker->unique()->phoneNumber,
            'seller_store_name' => $this->faker->company,
            'user_role' => $this->faker->word,
            'seller_created_at' => now(),
            'seller_updated_at' => now(),
        ];
    }
}
