<?php

namespace Database\Seeders;

use App\Models\FootballBet;
use App\Models\FootballTeam;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FootballBetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $football_teams = FootballTeam::all();

        foreach ($football_teams as $team) {
            FootballBet::create([
                'user_id' => 1,
                'football_team_id' => $team->id,
                'home_team_bet_score' => rand(1, 9),
                'away_team_bet_score' => rand(1, 9)
            ]);
        }

        FootballBet::factory()
            ->create();
    }
}
