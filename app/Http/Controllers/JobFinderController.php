<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentPattern;
use App\Enums\Gender;
use App\Enums\Handicap;
use App\Models\JobFinder;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class JobFinderController extends Controller
{
    public function index(): Response
    {
        $jobFinders = JobFinder::withCount('works')
            ->with(['skills:name', 'occupation:id,name'])
            ->orderBy('hired_at', 'desc')
            ->paginate(9);
        foreach ($jobFinders as $jobFinder) {
            $jobFinder->setAppends([
                'gender_label',
                'handicap_label',
                'employment_pattern_label',
                'hired',
                'period_of_use'
            ]);
        }
        return Inertia::render('JobFinder/Index', [
            'jobFinders' => $jobFinders->toArray(),
        ]);
    }
}
