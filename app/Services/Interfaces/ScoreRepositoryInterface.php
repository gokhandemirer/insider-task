<?php

namespace App\Services\Interfaces;

interface ScoreRepositoryInterface
{
    /**
     * @param int $homeScore
     * @param int $awayScore
     * @param int $matchId
     * @return void
     */
    public function create(int $homeScore, int $awayScore, int $matchId): void;

    /**
     * @return void
     */
    public function clear(): void;
}
