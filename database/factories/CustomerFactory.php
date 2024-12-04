<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition()
    {
        return [
            'cust_name' => $this->faker->name,
            'cust_email' => $this->faker->unique()->safeEmail,
            'cust_password' => bcrypt('password'), 
            'cust_phone' => $this->faker->unique()->phoneNumber,
            'cust_address' => $this->faker->address,
            'user_role' => $this->faker->word,
            'user_created_at' => now(),
            'user_updated_at' => now(),
        ];
    }
}
