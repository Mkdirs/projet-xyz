<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'code' => Str::upper(fake()->bothify('????-###-????')),
            'consumed_at' => null,
            'owner_id' => User::factory(),
            'consumer_id' => null
        ];
    }

    public function owned_by(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'owner_id' => $user
        ]);
    }

    public function consumed_by(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'consumer_id' => $user,
            'consumed_at' => now()
        ]);
    }
}
