<?php

namespace App\Services\Repositories;

use App\Models\Fixture;
use App\Services\Interfaces\FixtureRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FixtureRepository implements FixtureRepositoryInterface
{
    /**
     * @param int $week
     * @return Fixture
     */
    public function create(int $week): Fixture
    {
        $fixture = new Fixture();
        $fixture->week = $week;
        $fixture->save();

        return $fixture;
    }

    /**
     * @param int $week
     * @return Fixture
     */
    public function getFixtureByWeek(int $week): Fixture
    {
        return Fixture::where('week', $week)->firstOrFail();
    }

    /**
     * @param int $week
     * @return Collection
     */
    public function getFixturesAfterWeek(int $week): Collection
    {
        return Fixture::where('week', '>=', $week)->with('matches')->get();
    }

    /**
     * @return int
     */
    public function getTotalFixtureCount(): int
    {
        return Fixture::count();
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        Fixture::truncate();
    }
}
