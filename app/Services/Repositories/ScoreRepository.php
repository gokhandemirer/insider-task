<?php

namespace App\Services\Repositories;

use App\Models\Score;
use App\Services\Interfaces\ScoreRepositoryInterface;

class ScoreRepository implements ScoreRepositoryInterface
{
    /**
     * @param int $homeScore
     * @param int $awayScore
     * @param int $matchId
     * @return void
     */
    public function create(int $homeScore, int $awayScore, int $matchId): void
    {
        Score::create([
            'home_score'    =>  $homeScore,
            'away_score'    =>  $awayScore,
            'match_id'      =>  $matchId,
        ]);
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        Score::truncate();
    }
}
