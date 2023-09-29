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
            ->with(['skills:name', 'occupation:id,name', 'handicaps:name'])
            ->orderBy('hired_at', 'desc')
            ->paginate(9);
        foreach ($jobFinders as $jobFinder) {
            $jobFinder->setAppends([
                'gender_label',
                'employment_pattern_label',
                'hired',
                'period_of_use'
            ]);
        }
        return Inertia::render('Portfolio/Index', [
            'jobFinders' => $jobFinders->toArray(),
        ]);
    }

    public function show(string $id)
    {
        return Inertia::render('Portfolio/Show', [
            'jobFinder' => JobFinder::with(['skills:name', 'occupation:id,name', 'handicaps:name', 'works'])
                ->find($id)
                ->setAppends([
                    'gender_label',
                    'employment_pattern_label',
                    'hired',
                    'period_of_use'
                ])
                ->toArray()
        ]);
    }
}
