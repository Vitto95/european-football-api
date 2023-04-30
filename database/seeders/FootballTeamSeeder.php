<?php

namespace Database\Seeders;

use App\Models\FootballTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FootballTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FootballTeam::factory()
            ->count(50)
            ->create();
    }
}
