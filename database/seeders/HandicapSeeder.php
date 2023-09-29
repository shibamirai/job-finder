<?php

namespace Database\Seeders;

use App\Models\Handicap;
use Illuminate\Database\Seeder;

class HandicapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Handicap::create([
            'name' => '非公表',
        ]);
        Handicap::create([
            'name' => '精神',
        ]);
        Handicap::create([
            'name' => '身体',
        ]);
        Handicap::create([
            'name' => '療育',
        ]);
    }
}
