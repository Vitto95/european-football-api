<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class FootballBetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'attributes' => [
                'homeTeamBetScore' => $this->home_team_bet_score,
                'awayTeamBetScore' => $this->away_team_bet_score,
                'userName' => Auth::user()->name,
            ]
        ];
    }
}
