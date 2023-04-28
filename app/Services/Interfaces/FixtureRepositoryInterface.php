<?php

namespace App\Services\Interfaces;

use App\Models\Fixture;
use Illuminate\Database\Eloquent\Collection;

interface FixtureRepositoryInterface
{
    /**
     * @param int $week
     * @return Fixture
     */
    public function create(int $week): Fixture;

    /**
     * @param int $week
     * @return Fixture
     */
    public function getFixtureByWeek(int $week): Fixture;

    /**
     * @param int $week
     * @return Collection
     */
    public function getFixturesAfterWeek(int $week): Collection;

    /**
     * @return int
     */
    public function getTotalFixtureCount(): int;

    /**
     * @return void
     */
    public function clear(): void;
}
