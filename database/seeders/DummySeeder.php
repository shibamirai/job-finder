<?php

namespace Database\Seeders;

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
        $skills = Skill::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'Java'],
                ['name' => 'PHP'],
                ['name' => 'Python'],
            ))
            ->create();
        $occupations = Occupation::factory()
            ->count(5)
            ->state(new Sequence(
                ['name' => 'プログラマ', 'is_it' => true],
                ['name' => 'システムエンジニア', 'is_it' => true],
                ['name' => '営業'],
                ['name' => '接客'],
                ['name' => '事務'],
            ))
            ->create();
        $jobFinders = JobFinder::factory()
            ->count(50)
            ->recycle($occupations)
            ->create()
            ->each(fn ($jobFinder) =>
                $jobFinder
                    ->skills()
                    ->attach($skills->random(random_int(1, 3)))
            );
        Work::factory(10)
            ->recycle($jobFinders)
            ->create();
    }
}
