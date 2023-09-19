<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentPattern;
use App\Enums\Gender;
use App\Enums\Handicap;
use App\Models\JobFinder;
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

        // 障害別人数
        $handicaps = [];
        foreach (Handicap::cases() as $case) {
            $handicaps[] = [
                'name' => $case->label(),
                'count' => JobFinder::where('handicap', $case)->count()
            ];
        }
        // [0:非公表]を配列の最後へ移動
        array_push($handicaps, array_shift($handicaps));

        // 雇用形態別人数
        $employment_patterns = [];
        foreach (EmploymentPattern::cases() as $case) {
            $employment_patterns[] = [
                'name' => $case->label(),
                'count' => JobFinder::where('employment_pattern', $case)->count()
            ];
        }
        // [0:不明]を配列の最後へ移動
        array_push($employment_patterns, array_shift($employment_patterns));

        return Inertia::render('Statistics/Index', [
            // 総就職人数
            'total' => JobFinder::count(),
            // 就職者年齢の配列
            'ages' => JobFinder::get(['age'])
                ->map(fn ($jobFinder) => $jobFinder->age),
            // スキル別人数
            'skills' => DB::table('job_finder_skill')
                ->leftJoin('skills', 'job_finder_skill.skill_id', '=', 'skills.id')
                ->select('skills.name', DB::raw("count(skills.name) as count"))
                ->groupBy('skills.name')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray(),
            // IT系職種の人数
            'count_it' => JobFinder::whereHas('occupation', function ($q) {
                $q->where('is_it', 1);
            })->count(),
            // 性別ごとの人数
            'genders' => $genders,
            // 障害別人数
            'handicaps' => $handicaps,
            // 雇用形態別人数
            'employment_patterns' => $employment_patterns,
        ]);
    }
}
