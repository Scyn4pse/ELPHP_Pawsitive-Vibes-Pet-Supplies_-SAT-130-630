<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{

    public function definition()
    {
        return [
            'user_id' => $this->faker->id, 
            'notif_user_type' => $this->faker->word, 
            'notif_message' => $this->faker->sentence,
            'notif_created_at' => $this->faker->dateTime(now()),
            'notif_is_read' => $this->faker->boolean, 
        ];
    }
}
