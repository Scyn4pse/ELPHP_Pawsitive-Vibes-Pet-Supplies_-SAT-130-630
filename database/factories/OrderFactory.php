<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class OrderFactory extends Factory
{

    public function definition()
    {
        return [
            'order_item_id' => \App\Models\OrderItem::factory(),
            'cust_id' => \App\Models\Customer::factory(),
            'order_date' => now(),
            'order_total' => $this->faker->numberBetween(100, 10000),
            'order_status' => 'pending',
            'order_created_at' => now(),
            'order_updated_at' => now(),
        ];
    }

}
