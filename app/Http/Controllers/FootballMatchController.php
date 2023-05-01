<?php

namespace App\Http\Controllers;

use App\Http\Requests\FootballBetRequest;
use App\Http\Resources\FootballMatchResource;
use App\Models\FootballBet;
use App\Models\FootballMatch;
use App\Models\User;
use Illuminate\Http\Request;

class FootballMatchController extends Controller
{
    public function index(Request $request)
    {
        $football_matches = FootballMatch::query();

        if ($request->bettable) {
            $football_matches = $football_matches->bettable();
        } elseif ($request->past) {
            $football_matches = $football_matches->past();
        }

        $football_matches = $football_matches->orderBy('starts_at')->get();

        return FootballMatchResource::collection($football_matches);
    }

    public function storeBet(FootballBetRequest $request, FootballMatch $footballMatch, User $user)
    {
        $football_bet = FootballBet::whereFootballMatchId($footballMatch->id)
            ->whereUserId($user->id)
            ->exists();

        if (($football_bet)) {
            return "Already bet";
        }

        FootballBet::create([
            'user_id' => $user->id,
            'football_match_id' => $footballMatch->id,
            'home_team_bet_score' => $request->homeTeamBetScore,
            'away_team_bet_score' => $request->awayTeamBetScore,
        ]);
    }
}
