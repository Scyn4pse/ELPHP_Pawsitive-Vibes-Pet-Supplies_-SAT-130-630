<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{

    public function definition()
    {
        return [
            'cust_id' => \App\Models\Customer::factory(),
            'cart_item_id' => \App\Models\CartItem::factory(),
            'cart_created_at' => now(),
            'cart_updated_at' => now(),
        ];
    }

}
