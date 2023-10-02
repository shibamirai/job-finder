<?php

namespace Database\Factories;

use App\Models\EmploymentPattern;
use App\Models\Gender;
use App\Models\Occupation;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $genders = Gender::get('id')->toArray();
        $occupations = Occupation::get('id')->toArray();
        $employmentPatterns = EmploymentPattern::get('id')->toArray();
        $use_from = $this->faker->dateTimeBetween('-4 years', '-1 year');
        $interval = (int)date_diff($use_from, new DateTime('now'))->format('%a');

        return [
            'avatar' => Arr::random($avatars),
            'name' => $this->faker->name(),
            'gender_id' => Arr::random($genders)['id'],
            'age' => $this->faker->numberBetween(19, 55),
            'has_certificate' => $this->faker->boolean(80),
            'use_from' => $use_from->format('Y-m-d'),
            'occupation_id' => Arr::random($occupations)['id'],
            'description' => $this->faker->realText(60),
            'hired_at' => $use_from->modify(rand(4, round($interval/30)) . ' months')->format('Y-m-d'),
            'employment_pattern_id' => Arr::random($employmentPatterns)['id'],
            'is_handicaps_opened' => $this->faker->boolean(65),
        ];
    }
}
