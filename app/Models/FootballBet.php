<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballBet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'football_match_id',
        'home_team_bet_score',
        'away_team_bet_score'
    ];
}
