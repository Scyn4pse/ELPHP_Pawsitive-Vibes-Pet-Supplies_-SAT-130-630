<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cust_id' => \App\Models\Customer::factory(),
            'cart_item_id' => \App\Models\CartItem::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
