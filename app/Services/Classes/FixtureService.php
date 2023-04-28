<?php

namespace App\Services\Classes;

use App\Services\Interfaces\FixtureRepositoryInterface;
use App\Services\Interfaces\MatchRepositoryInterface;
use App\Services\Interfaces\TeamRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FixtureService
{
    /**
     * @var Collection
     */
    private Collection $teams;

    /**
     * @var int
     */
    private int $numOfTeams;

    /**
     * @var int
     */
    private int $matchesPerRound;

    /**
     * @var int
     */
    private int $numOfRounds;

    public function __construct(
        protected TeamRepositoryInterface $teamRepository,
        protected MatchRepositoryInterface $matchRepository,
        protected FixtureRepositoryInterface $fixtureRepository,
    )
    {
        $this->_init();
    }

    /**
     * @return void
     */
    private function _init()
    {
        // Fetch all teams
        $this->teams = $this->teamRepository->index();

        $this->numOfTeams = count($this->teams);

        // Calculate number of matches per round
        $this->matchesPerRound = $this->numOfTeams / 2;

        // Calculate number of rounds
        $this->numOfRounds = $this->numOfTeams - 1;
    }

    /**
     * @return array
     */
    private function createRounds(): array
    {
        // Generate rounds
        $rounds = [];

        $numOfTeams = $this->numOfTeams;
        $teams = $this->teams->pluck('id');

        for ($i = 0; $i < $this->numOfRounds; $i++) {
            $matches = array();

            // Generate matches for each round
            for ($j = 0; $j < $this->matchesPerRound; $j++) {
                $home = ($i + $j) % ($numOfTeams - 1);
                $away = ($numOfTeams - 1 - $j + $i) % ($numOfTeams - 1);

                if ($j == 0) {
                    $away = $numOfTeams - 1;
                }

                $matches[] = array($teams[$home], $teams[$away]);
            }

            // Shuffle matches to avoid consecutive home matches
            if ($i % 2 == 1) {
                $matches = array_reverse($matches);
            }

            $rounds[] = $matches;
        }

        return $rounds;
    }

    /**
     * @return array
     */
    public function createFixture(): array
    {
        $rounds = $this->createRounds();
        $numOfRounds = $this->numOfRounds;

        $this->fixtureRepository->clear();
        $this->matchRepository->clear();

        $teamNames = $this->teams->pluck('name', 'id');
        $groups = [];

        try {
            DB::beginTransaction();

            for ($roundNum = 1; $roundNum <= $numOfRounds * 2; $roundNum++) {
                $fixture = $this->fixtureRepository->create($roundNum);
                $groups[$roundNum] = [];

                if ($roundNum <= $numOfRounds) {
                    foreach ($rounds[$roundNum - 1] as $match) {
                        $this->matchRepository->create($match[0], $match[1], $fixture->id);
                        $groups[$roundNum][] = [$teamNames[$match[0]], $teamNames[$match[1]]];
                    }
                } else {
                    $roundIndex = ($roundNum - $numOfRounds - 1);
                    foreach ($rounds[$roundIndex] as $match) {
                        $this->matchRepository->create($match[1], $match[0], $fixture->id);
                        $groups[$roundNum][] = [$teamNames[$match[1]], $teamNames[$match[0]]];
                    }
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $groups;
    }
}
