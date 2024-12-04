<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'seller_id' => \App\Models\Seller::factory(),
            'prod_name' => $this->faker->word,
            'prod_description' => $this->faker->sentence,
            'prod_price' => $this->faker->randomFloat(2, 10, 1000),
            'prod_quantity' => $this->faker->numberBetween(1, 100),
            'prod_image' => $this->faker->imageUrl(640, 480, 'products', true),
            'prod_created_at' => now(),
            'prod_updated_at' => now(),
        ];
    }

}
