<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentPattern;
use App\Enums\Gender;
use App\Enums\Handicap;
use App\Http\Requests\JobFinderRequest;
use App\Models\JobFinder;
use App\Models\Occupation;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class JobFinderController extends Controller
{
    public function index()
    {
        $jobFinders = JobFinder::with(['occupation:id,name'])
            ->orderBy('hired_at', 'desc')
            ->orderBy('id')
            ->filter(request(['search']))
            ->paginate(9)
            ->withQueryString();
        foreach ($jobFinders as $jobFinder) {
            $jobFinder->setAppends([
                'gender_label',
                'handicap_label',
                'employment_pattern_label',
                'hired',
                'period_of_use'
            ]);
        }
        return Inertia::render('JobFinders/Index', [
            'jobFinders' => $jobFinders->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('JobFinders/Edit',[
            'jobFinder' => JobFinder::with(['skills:name', 'occupation:id,name', 'works'])->find($id),
            'labels' => [
                'avatar' => array_map(
                    fn ($file) => $file->getFilename(), File::files(public_path('avatar'))
                ),
                'skill' => Skill::get(['name'])
                    ->map(fn ($skill) => $skill->name),
                'occupation' => Occupation::get(['name'])
                    ->map(fn ($occupation) => $occupation->name),
                'gender' => Gender::asSelectArray(),
                'handicap' => Handicap::asSelectArray(),
                'employment_pattern' => EmploymentPattern::asSelectArray(),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
