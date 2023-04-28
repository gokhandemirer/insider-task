<?php

namespace App\Http\Controllers;

use App\Services\Classes\FixtureService;
use Inertia\Inertia;

class FixtureController extends Controller
{
    public function create()
    {
        /** @var FixtureService $fixtureService */
        $fixtureService = app()->make(FixtureService::class);
        $groups = $fixtureService->createFixture();

        return Inertia::render('Fixtures/Index', compact('groups'));
    }
}
