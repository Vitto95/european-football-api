<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FootballMatchRequest;
use App\Http\Requests\FootballMatchResultRequest;
use App\Http\Resources\Admin\FootballMatchResource;
use App\Models\FootballMatch;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FootballMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', FootballMatch::class);

        try {
            $football_matches = FootballMatch::query();

            if (isset($request->future)) {
                $football_matches = $football_matches->future();
            } elseif (isset($request->past)) {
                $football_matches = $football_matches->past();
            }

            $football_matches = $football_matches->get();

            return FootballMatchResource::collection($football_matches);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->error('Cannot create football match', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FootballMatchRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->authorize('create', FootballMatch::class);

            $starts_at = $request->startsDate . " " . $request->startsTime;

            $football_match = FootballMatch::create([
                'home_team_name' => $request->homeTeamName,
                'away_team_name' => $request->awayTeamName,
                'starts_at' => Carbon::parse($starts_at)->toDateTimeString(),
                'ends_at' => Carbon::parse($starts_at)->addHours(2)->toDateTimeString()
            ]);

            DB::commit();

            return new FootballMatchResource($football_match);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->error('Cannot create football match', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FootballMatch $footballMatch)
    {
        $this->authorize('view', FootballMatch::class);

        try {
            return new FootballMatchResource($footballMatch);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->error('Cannot create football match', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FootballMatchRequest $request, FootballMatch $footballMatch)
    {
        $this->authorize('update', FootballMatch::class);

        try {
            $starts_at = $request->startsDate . " " . $request->startsTime;

            $footballMatch->home_team_name = $request->homeTeamName;
            $footballMatch->away_team_name = $request->awayTeamName;
            $footballMatch->starts_at = Carbon::parse($starts_at)->toDateTimeString();
            $footballMatch->ends_at = Carbon::parse($starts_at)->addHours(2)->toDateTimeString();

            $footballMatch->save();

            return new FootballMatchResource($footballMatch);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->error('Cannot update football match', 500);
        }
    }

    /**
     * Submit the result of football match.
     */
    public function submitResult(FootballMatchResultRequest $request, FootballMatch $footballMatch)
    {
        $this->authorize('submitResult', FootballMatch::class);

        try {

            $footballMatch->home_team_score = $request->homeTeamScore;
            $footballMatch->away_team_score = $request->awayTeamScore;

            $footballMatch->save();

            return new FootballMatchResource($footballMatch);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->error('Cannot submit result of football match', 500);
        }
    }

    /**
     * Delete the specified resource from storage.
     */
    public function delete(FootballMatch $football_match)
    {
        $football_match->delete();
    }
}
