<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FootballMatchRequest;
use App\Http\Requests\FootballMatchResultRequest;
use App\Http\Resources\FootballMatchResource;
use App\Models\FootballMatch;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class FootballMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $football_matches = FootballMatch::query();

        if (isset($request->future)) {
            $football_matches = $football_matches->future();
        } elseif (isset($request->past)) {
            $football_matches = $football_matches->past();
        }

        $football_matches = $football_matches->get();

        return FootballMatchResource::collection($football_matches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FootballMatchRequest $request)
    {
        $starts_at = $request->startsDate . " " . $request->startsTime;

        FootballMatch::create([
            'home_team_name' => $request->homeTeamName,
            'away_team_name' => $request->awayTeamName,
            'starts_at' => Carbon::parse($starts_at)->toDateTimeString(),
            'ends_at' => Carbon::parse($starts_at)->addHours(2)->toDateTimeString()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FootballMatch $footballMatch)
    {
        return new FootballMatchResource($footballMatch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FootballMatchRequest $request, FootballMatch $footballMatch)
    {
        $starts_at = $request->startsDate . " " . $request->startsTime;

        $footballMatch->home_team_name = $request->homeTeamName;
        $footballMatch->away_team_name = $request->awayTeamName;
        $footballMatch->starts_at = Carbon::parse($starts_at)->toDateTimeString();
        $footballMatch->ends_at = Carbon::parse($starts_at)->addHours(2)->toDateTimeString();

        $footballMatch->save();
    }

    /**
     * Submit the result of football match.
     */
    public function submitResult(FootballMatchResultRequest $request, FootballMatch $footballMatch)
    {
        $footballMatch->home_team_score = $request->homeTeamScore;
        $footballMatch->away_team_score = $request->awayTeamScore;

        $footballMatch->save();
    }

    /**
     * Delete the specified resource from storage.
     */
    public function delete(FootballMatch $football_match)
    {
        $football_match->delete();
    }
}
