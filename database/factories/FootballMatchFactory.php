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
        $home_team = FootballTeam::inRandomOrder()->first();
        $away_team = FootballTeam::where('id', '<>', $home_team->id)->first();
        $starts_at = null;

        // Cannot schedule same match twice in day, 
        // so get last scheduled match (if exists) and add random days and minutes.
        $scheduled_match = FootballMatch::whereHomeTeamId($home_team->id)
            ->whereAwayTeamId($away_team->id)
            ->first();

        if (!is_null($scheduled_match)) {
            $starts_at = Carbon::parse($scheduled_match->starts_at)->addDays(rand(1, 31))->addMinutes(rand(1, 59));
        } else {
            $starts_at = Carbon::now()->addDays(rand(1, 31))->addMinutes(rand(1, 59));
        }

        return [
            'home_team_id' => $home_team->id,
            'away_team_id' => $away_team->id,
            'starts_at' => $starts_at->toDateTimeString(),
            'ends_at' => $starts_at->addHours(2)->toDateTimeString()
        ];
    }
}
