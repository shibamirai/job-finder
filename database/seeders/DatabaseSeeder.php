<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EmploymentPatternSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(HandicapSeeder::class);
        $this->call(OccupationSeeder::class);
        $this->call(SkillSeeder::class);
    }
}
