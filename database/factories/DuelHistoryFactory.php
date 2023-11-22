<?php

namespace Database\Factories;

use App\Models\DuelHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DuelHistory>
 */
class DuelHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_id' => User::factory()->createOne(),
            'opponent_id' => User::factory()->createOne(),
            'won' => fake()->boolean(),
        ];
    }
}
