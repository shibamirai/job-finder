<?php

namespace Database\Factories;

use App\Models\Occupation;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobFinder>
 */
class JobFinderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $avatars = array_map(fn($file) => $file->getFilename(), File::files(public_path('avatar')));
        $use_from = $this->faker->dateTimeBetween('-4 years', '-1 year');
        $interval = (int)date_diff($use_from, new DateTime('now'))->format('%a');

        return [
            'avatar' => Arr::random($avatars),
            'name' => $this->faker->name(),
            'gender' => $this->faker->numberBetween(0, 2),
            'age' => $this->faker->numberBetween(19, 55),
            'has_certificate' => $this->faker->boolean(80),
            'use_from' => $use_from->format('Y-m-d'),
            'occupation_id' => Occupation::factory(),
            'description' => $this->faker->realText(60),
            'hired_at' => $use_from->modify(rand(4, round($interval/30)) . ' months')->format('Y-m-d'),
            'employment_pattern' => $this->faker->numberBetween(0, 6),
            'is_handicaps_opened' => $this->faker->boolean(65),
        ];
    }
}
