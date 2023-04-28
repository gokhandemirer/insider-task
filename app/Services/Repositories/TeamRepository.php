<?php

namespace App\Services\Repositories;

use App\Models\Team;
use App\Services\Interfaces\TeamRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Team::all();
    }

    /**
     * @param int $week
     * @return \Illuminate\Support\Collection
     */
    public function getStatistics(int $week): \Illuminate\Support\Collection
    {
        $results = DB::table('teams')
            ->select('teams.name')
            ->selectRaw('COUNT(scores.id) AS played')
            ->selectRaw('SUM(
                CASE WHEN (
                  teams.id = matches.home
                  AND scores.home_score > scores.away_score
                )
                OR (
                  teams.id = matches.away
                  AND scores.away_score > scores.home_score
                ) THEN 1 ELSE 0 END
              ) AS won')
            ->selectRaw('SUM(
                CASE WHEN (
                  teams.id = matches.home
                  AND scores.home_score < scores.away_score
                )
                OR (
                  teams.id = matches.away
                  AND scores.away_score < scores.home_score
                ) THEN 1 ELSE 0 END
              ) AS lost')
            ->selectRaw('SUM(
                CASE WHEN scores.home_score = scores.away_score THEN 1 ELSE 0 END
              ) AS drawn')
            ->selectRaw('SUM(
                CASE WHEN teams.id = matches.home
                AND scores.home_score > scores.away_score THEN scores.home_score - scores.away_score ELSE scores.away_score - scores.home_score END
              ) AS gd')
            ->selectRaw('ROUND((((SUM(CASE WHEN (teams.id = matches.home AND scores.home_score > scores.away_score) OR (teams.id = matches.away AND scores.away_score > scores.home_score) THEN 3 WHEN scores.home_score = scores.away_score THEN 1 ELSE 0 END) / (COUNT(*) * 3.0)) * 3) + ((SUM(CASE WHEN scores.home_score = scores.away_score THEN 1 ELSE 0 END) / COUNT(*)) * 1)) * 100, 2) AS championship_percentage')
            ->join('matches', function ($join) {
                $join->on('teams.id', '=', 'matches.home');
                $join->orOn('teams.id', '=', 'matches.away');
            })
            ->join('fixtures', 'matches.fixture_id', '=', 'fixtures.id')
            ->leftJoin('scores', 'scores.match_id', '=', 'matches.id')
            ->where('fixtures.week', '<=', $week)
            ->groupBy('teams.id')
            ->get();

        return $results;
    }
}
