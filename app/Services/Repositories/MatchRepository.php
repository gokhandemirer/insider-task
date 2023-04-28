<?php

namespace App\Services\Repositories;

use App\Models\MatchModel;
use App\Services\Interfaces\MatchRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MatchRepository implements MatchRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return MatchModel::all();
    }

    /**
     * @param int $home
     * @param int $away
     * @param int $fixtureId
     * @return MatchModel
     */
    public function create(int $home, int $away, int $fixtureId): MatchModel
    {
        $matchModel = new MatchModel();
        $matchModel->home = $home;
        $matchModel->away = $away;
        $matchModel->fixture_id = $fixtureId;
        $matchModel->save();

        return $matchModel;
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        MatchModel::truncate();
    }
}
