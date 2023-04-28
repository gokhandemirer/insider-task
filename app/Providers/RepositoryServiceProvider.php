<?php

namespace App\Providers;

use App\Services\Interfaces\FixtureRepositoryInterface;
use App\Services\Interfaces\MatchRepositoryInterface;
use App\Services\Interfaces\ScoreRepositoryInterface;
use App\Services\Interfaces\TeamRepositoryInterface;
use App\Services\Repositories\FixtureRepository;
use App\Services\Repositories\MatchRepository;
use App\Services\Repositories\ScoreRepository;
use App\Services\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(MatchRepositoryInterface::class, MatchRepository::class);
        $this->app->bind(FixtureRepositoryInterface::class, FixtureRepository::class);
        $this->app->bind(ScoreRepositoryInterface::class, ScoreRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
