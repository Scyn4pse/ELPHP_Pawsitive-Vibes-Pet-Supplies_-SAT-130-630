<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cart_id' => \App\Models\Cart::factory(),
            'prod_id' => \App\Models\Product::factory(),
            'cart_quantity' => $this->faker->numberBetween(1, 10),
            'cart_price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }

}
