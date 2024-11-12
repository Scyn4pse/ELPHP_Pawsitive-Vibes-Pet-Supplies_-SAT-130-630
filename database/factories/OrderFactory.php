<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'order_date' => now(),
            'order_total' => $this->faker->numberBetween(100, 10000),
            'order_status' => 'pending', // You can use different statuses like 'pending', 'shipped', etc.
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
