<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $appends = ['home_team_name', 'away_team_name'];

    public function getHomeTeamNameAttribute()
    {
        return Team::find($this->getAttribute('home'))->name;
    }

    public function getAwayTeamNameAttribute()
    {
        return Team::find($this->getAttribute('away'))->name;
    }
}
