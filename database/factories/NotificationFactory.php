<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition(): array
    {
        $types = ['success', 'error', 'danger', 'primary', 'secondary'];

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'type' => $types[array_rand($types)],
            'is_read' => false,
            'title' => $this->faker->text(18),
            'message' => $this->faker->realText(32),
        ];
    }
}
