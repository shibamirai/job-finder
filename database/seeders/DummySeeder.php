<?php

namespace Database\Seeders;

use App\Models\Handicap;
use App\Models\JobFinder;
use App\Models\Occupation;
use App\Models\Skill;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $handicaps = Handicap::all();
        $skills = Skill::all();
        $jobFinders = JobFinder::factory()
            ->count(50)
            ->create()
            ->each(function ($jobFinder) use ($handicaps, $skills) {
                $jobFinder
                    ->handicaps()
                    ->attach($handicaps->random(random_int(0, 3)));
                $jobFinder
                    ->skills()
                    ->attach($skills->random(random_int(0, 3)));
                return $jobFinder;
            });
        Work::factory(10)
            ->recycle($jobFinders)
            ->create();
    }
}
