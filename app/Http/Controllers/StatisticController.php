<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Models\EmploymentPattern;
use App\Models\Handicap;
use App\Models\JobFinder;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class StatisticController extends Controller
{
    public function index() : Response
    {
        // 性別ごとの人数
        $genders = [];
        foreach (Gender::cases() as $case) {
            $genders[] = [
                'name' => $case->label(),
                'count' => JobFinder::where('gender', $case)->count()
            ];
        }
        // [0:非公表]を配列の最後へ移動
        array_push($genders, array_shift($genders));

        return Inertia::render('Statistics/Index', [
            // 総就職人数
            'total' => JobFinder::count(),
            // 就職者年齢の配列
            'ages' => JobFinder::get(['age'])
                ->map(fn ($jobFinder) => $jobFinder->age),
            // スキル別人数
            'skills' => Skill::withCount(['masters'])->get()->toArray(),
            // IT系職種の人数
            'count_it' => JobFinder::whereHas('occupation', function ($q) {
                $q->where('is_it', 1);
            })->count(),
            // 性別ごとの人数
            'genders' => $genders,
            // 障害別人数
            'handicaps' => Handicap::withCount(['affects'])->get()->toArray(),
            // 雇用形態別人数
            'employment_patterns' => EmploymentPattern::withCount('workers')->orderBy('sort')->get()->toArray(),
        ]);
    }
}
