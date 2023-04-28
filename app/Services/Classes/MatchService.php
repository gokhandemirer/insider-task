<?php

namespace App\Services\Classes;

use App\Services\Interfaces\FixtureRepositoryInterface;
use App\Services\Interfaces\MatchRepositoryInterface;
use App\Services\Interfaces\ScoreRepositoryInterface;

class MatchService
{
    /**
     * @var SimulationService
     */
    protected SimulationService $simulationService;

    public function __construct(
        protected MatchRepositoryInterface $matchRepository,
        protected ScoreRepositoryInterface $scoreRepository,
        protected FixtureRepositoryInterface $fixtureRepository,
    )
    {
        /** @var SimulationService simulationService */
        $this->simulationService = app()->make(SimulationService::class);
    }

    /**
     * @param int $matchId
     * @return void
     */
    private function createScore(int $matchId): void
    {
        $homeScore = rand(0, 7);
        $awayScore = rand(0, 7);

        $this->scoreRepository->create($homeScore, $awayScore, $matchId);
    }

    public function playAllMatches()
    {
        if ($this->simulationService->isFinalized()) {
            return false;
        }

        $fixture = $this->fixtureRepository->getFixturesAfterWeek($this->simulationService->getCurrentWeek());

        $fixture->each(function ($group) {
            $group->matches->each(function ($match) {
                $this->createScore($match->id);
            });
        });

        $this->simulationService->setLastCurrentWeek();
        $this->simulationService->setFinalized(true);
    }

    public function playNext()
    {
        if ($this->simulationService->isFinalized()) {
            return false;
        }

        $currentWeek = $this->simulationService->getCurrentWeek();
        $fixture = $this->fixtureRepository->getFixtureByWeek($currentWeek);

        $fixture->matches->each(function ($match) {
            $this->createScore($match->id);
        });

        $this->simulationService->increaseCurrentWeek();

        if ($this->simulationService->isLastWeek()) {
            $this->simulationService->setFinalized(true);
        }
    }
}
