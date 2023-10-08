<?php

namespace App\Http\Controllers;

use App\Models\JobFinder;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(): Response
    {
        $jobFinders = JobFinder::withCount('works')
            ->with([
                'employmentPattern:id,name',
                'gender:id,name',
                'handicaps:name',
                'occupation:id,name',
                'skills:name',
            ])
            ->orderBy('hired_at', 'desc')
            ->paginate(9);
        foreach ($jobFinders as $jobFinder) {
            $jobFinder->setAppends([
                'hired',
                'period_of_use'
            ]);
        }
        return Inertia::render('Portfolio/Index', [
            'jobFinders' => $jobFinders,
        ]);
    }

    public function show(JobFinder $jobFinder)
    {
        $jobFinder->load([
            'employmentPattern:id,name',
            'gender:id,name',
            'handicaps:name',
            'occupation:id,name',
            'skills:name',
            'works'
        ])->setAppends([
            'hired',
            'period_of_use'
        ]);

        return Inertia::render('Portfolio/Show', [
            'jobFinder' => $jobFinder
        ]);
    }
}
