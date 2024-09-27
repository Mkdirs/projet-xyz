<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvitationCode>
 */
class InvitationCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->bothify('????-####-????'),
            'consumed_at' => null,
            'owner_id' => User::factory(),
            'consumer_id' => null
        ];
    }

    public function consumed(): static
    {
        return $this->state(fn (array $attributes) => [
            'consumer_id' => User::factory(),
            'consumed_at' => now()
        ]);
    }
}
