<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'seller_id' => \App\Models\Seller::factory(),
            'prod_name' => $this->faker->unique()->word,
            'prod_description' => $this->faker->sentence,
            'prod_price' => $this->faker->randomFloat(2, 10, 1000),
            'prod_quantity' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
