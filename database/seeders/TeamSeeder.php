<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = ['Arsenal', 'Liverpool', 'Manchester City', 'Chelsea'];

        Team::truncate();

        foreach ($teams as $_team) {
            $team = new Team();
            $team->name = $_team;
            $team->save();
        }
    }
}
