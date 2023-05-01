<?php

namespace Database\Factories;

use App\Models\FootballMatch;
use App\Models\FootballTeam;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FootballMatch>
 */
class FootballMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $starts_at = Carbon::now()->subDays(rand(1, 7))->addDays(rand(2, 31))->addMinutes(rand(1, 59));

        return [
            'home_team_name' => fake()->unique()->city(),
            'away_team_name' => fake()->unique()->city(),
            'starts_at' => $starts_at->toDateTimeString(),
            'ends_at' => $starts_at->addHours(2)->toDateTimeString()
        ];
    }
}
