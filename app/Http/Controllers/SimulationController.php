<?php

namespace App\Http\Controllers;

use App\Services\Classes\MatchService;
use App\Services\Classes\SimulationService;
use App\Services\Interfaces\FixtureRepositoryInterface;
use App\Services\Interfaces\ScoreRepositoryInterface;
use App\Services\Interfaces\TeamRepositoryInterface;
use Inertia\Inertia;

class SimulationController extends Controller
{
    public function __construct(
        protected ScoreRepositoryInterface $scoreRepository,
        protected FixtureRepositoryInterface $fixtureRepository,
        protected TeamRepositoryInterface $teamRepository,
    )
    {
    }

    public function index()
    {
        $simulationService = app()->make(SimulationService::class);
        $currentWeek = $simulationService->getCurrentWeek();

        $fixture = $this->fixtureRepository->getFixtureByWeek($currentWeek);
        $matches = $fixture->matches;
        $statistics = $this->teamRepository->getStatistics($currentWeek);

        return Inertia::render('Simulation/Index', [
            'week'          =>  $currentWeek,
            'matches'       =>  $matches,
            'statistics'    =>  $statistics
        ]);
    }

    public function playAll()
    {
        /** @var MatchService $matchService */
        $matchService = app()->make(MatchService::class);
        $matchService->playAllMatches();

        return redirect()->route('simulation.index');
    }

    public function playNext()
    {
        /** @var MatchService $matchService */
        $matchService = app()->make(MatchService::class);
        $matchService->playNext();

        return redirect()->route('simulation.index');
    }

    public function reset()
    {
        $simulationService = app()->make(SimulationService::class);

        $this->scoreRepository->clear();
        $simulationService->resetCurrentWeek();
        $simulationService->setFinalized(false);

        return redirect()->route('simulation.index');
    }
}
