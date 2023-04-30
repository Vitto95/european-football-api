<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FootballMatchResource extends JsonResource
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
                'homeTeamName' => $this->home_team_name,
                'awayTeamName' => $this->away_team_name,
                'startsAt' => $this->starts_at,
                'startsDate' => Carbon::parse($this->starts_at)->toDateString(),
                'startsTime' => Carbon::parse($this->starts_at)->toTimeString(),
                'endsAt' => $this->ends_at,
                'homeTeamScore' => $this->home_team_score,
                'awayTeamsScore' => $this->away_team_score
            ],
        ];
    }
}
