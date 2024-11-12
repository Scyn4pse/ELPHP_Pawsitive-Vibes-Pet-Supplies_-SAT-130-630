<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100), 
            'notif_user_type' => $this->faker->numberBetween(1, 3), 
            'notif_message' => $this->faker->sentence,
            'notif_is_read' => $this->faker->boolean, 
        ];
    }
}
