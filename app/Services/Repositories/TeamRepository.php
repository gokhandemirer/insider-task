<?php

namespace App\Services\Repositories;

use App\Models\Team;
use App\Services\Interfaces\TeamRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Team::all();
    }
}
