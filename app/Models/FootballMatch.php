<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FootballMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'football_matches';

    protected $fillable = [
        'home_team_name',
        'away_team_name',
        'starts_at',
        'ends_at'
    ];

    // RELATIONSHIPS 

    // public function home_team()
    // {
    //     return $this->belongsTo(FootballTeam::class, 'home_team_id', 'id');
    // }

    // public function away_team()
    // {
    //     return $this->belongsTo(FootballTeam::class, 'away_team_id', 'id');
    // }

    // SCOPES

    /**
     * Scope a query to only include future matches.
     */
    public function scopeFuture(Builder $query)
    {
        $query->where('starts_at', '>=', Carbon::now());
    }

    /**
     * Scope a query to only include past matches.
     */
    public function scopePast(Builder $query)
    {
        $query->where('ends_at', '<', Carbon::now());
    }

    /**
     * Scope a query to only include bettable matches.
     */
    public function scopeBettable(Builder $query)
    {
        $query->where('starts_at', '>', Carbon::now()->addMinutes(30));
    }

    // ATTRIBUTES

    public function getFormattedNameAttribute()
    {
        return $this->home_team->name . ' - ' . $this->away_team->name;
    }
}
