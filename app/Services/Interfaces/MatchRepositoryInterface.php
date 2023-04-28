<?php

namespace App\Services\Interfaces;

use App\Models\MatchModel;
use Illuminate\Database\Eloquent\Collection;

interface MatchRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param int $home
     * @param int $away
     * @param int $fixtureId
     * @return MatchModel
     */
    public function create(int $home, int $away, int $fixtureId): MatchModel;

    /**
     * @return void
     */
    public function clear(): void;
}
