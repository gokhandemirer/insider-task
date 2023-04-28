<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TeamRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param int $week
     * @return \Illuminate\Support\Collection
     */
    public function getStatistics(int $week): \Illuminate\Support\Collection;
}
