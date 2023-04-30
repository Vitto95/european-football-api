<?php

namespace Database\Seeders;

use App\Models\FootballBet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FootballBetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FootballBet::factory()
            ->create();
    }
}
