<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getRanking()
    {
        $ranking = DB::table('users AS u')
            ->join('football_bets AS fb', 'u.id', '=', 'fb.user_id')
            ->join('football_matches AS fm', 'fb.football_match_id', '=', 'fm.id')
            ->whereColumn('fb.home_team_bet_score', 'fm.home_team_score')
            ->whereColumn('fb.away_team_bet_score', 'fm.away_team_score')
            ->select('u.id', 'u.name', DB::raw('COUNT(*) as winning_bets'))
            ->groupBy('user_id', 'u.name')
            ->orderBy('winning_bets', 'desc')
            ->get();


        return $ranking;
    }
}
