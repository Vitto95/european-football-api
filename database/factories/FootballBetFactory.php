<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FootballBet>
 */
class FootballBetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'football_match_id' => 200,
            'home_team_bet_score' => fake()->numberBetween(0, 7),
            'away_team_bet_score' => fake()->numberBetween(0, 7),
        ];
    }
}
