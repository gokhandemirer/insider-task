<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Services\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * @param TeamRepositoryInterface $teamRepository
     */
    public function __construct(
        public TeamRepositoryInterface $teamRepository
    )
    {
    }

    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        $teams = $this->teamRepository->index();
        return Inertia::render('Home', compact('teams'));
    }
}
