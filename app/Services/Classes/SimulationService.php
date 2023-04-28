<?php

namespace App\Services\Classes;

use App\Services\Interfaces\FixtureRepositoryInterface;
use Illuminate\Support\Facades\Session;

class SimulationService
{
    /**
     * @var int
     */
    private int $currentWeek;

    /**
     * @var bool
     */
    private bool $finalized;

    /**
     * @var int
     */
    private int $fixtureCount;

    public function __construct(
        protected FixtureRepositoryInterface $fixtureRepository
    )
    {
        $this->_init();
    }

    public function _init()
    {
        $this->fixtureCount = $this->fixtureRepository->getTotalFixtureCount();
        $this->setCurrentWeek(
            Session::has('currentWeek') ? Session::get('currentWeek') : 1
        );
        $this->setFinalized(
            Session::has('finalized') ? Session::get('finalized') : false
        );
    }

    /**
     * @return bool
     */
    public function isLastWeek(): bool
    {
        return $this->currentWeek == $this->fixtureCount;
    }

    /**
     * @return void
     */
    public function increaseCurrentWeek()
    {
        if (!$this->isLastWeek()) {
            $this->setCurrentWeek($this->currentWeek + 1);
        }
    }

    /**
     * @return void
     */
    public function resetCurrentWeek()
    {
        $this->setCurrentWeek(1);
    }

    /**
     * @return void
     */
    public function setLastCurrentWeek()
    {
        $this->setCurrentWeek(
            $this->fixtureRepository->getTotalFixtureCount()
        );
    }

    /**
     * @return int
     */
    public function getCurrentWeek(): int
    {
        return $this->currentWeek;
    }

    /**
     * @param int $currentWeek
     */
    public function setCurrentWeek(int $currentWeek): void
    {
        $this->currentWeek = $currentWeek;
        Session::put('currentWeek', $currentWeek);
    }

    /**
     * @param bool $finalized
     */
    public function setFinalized(bool $finalized): void
    {
        $this->finalized = $finalized;
        Session::put('finalized', $finalized);
    }

    /**
     * @return bool
     */
    public function isFinalized(): bool
    {
        return $this->finalized;
    }
}
