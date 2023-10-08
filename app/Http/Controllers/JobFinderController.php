<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobFinderRequest;
use App\Models\EmploymentPattern;
use App\Models\Gender;
use App\Models\Handicap;
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
        $jobFinders = JobFinder::with([
                'employmentPattern:id,name',
                'gender:id,name',
                'occupation:id,name'
            ])
            ->orderBy('hired_at', 'desc')
            ->orderBy('id')
            ->filter(request(['search']))
            ->paginate(9)
            ->withQueryString();
        foreach ($jobFinders as $jobFinder) {
            $jobFinder->setAppends([
                'hired',
                'period_of_use'
            ]);
        }
        return Inertia::render('JobFinders/Index', [
            'jobFinders' => $jobFinders->toArray(),
        ]);
    }

    public function create()
    {
        return Inertia::render('JobFinders/Create',[
            'employmentPatterns' => EmploymentPattern::orderBy('sort')->get(['id', 'name']),
            'genders' => Gender::orderBy('sort')->get(['id', 'name']),
            'handicaps' => Handicap::orderBy('sort')->get(['id', 'name']),
            'labels' => [
                'avatar' => array_map(
                    fn ($file) => $file->getFilename(), File::files(public_path('avatar'))
                ),
                'skill' => Skill::get(['name'])
                    ->map(fn ($skill) => $skill->name),
                'occupation' => Occupation::get(['name'])
                    ->map(fn ($occupation) => $occupation->name),
            ]
        ]);
    }

    public function store(JobFinderRequest $request)
    {
        DB::beginTransaction();
        try {
            $occupation = Occupation::firstOrCreate([
                'name' => $request->safe()->occupation
            ]);

            $attributes = $request->safe()
                ->merge(['occupation_id' => $occupation->id])
                ->except(['skills', 'occupation', 'handicaps']);
            $jobFinder = JobFinder::create($attributes);

            $jobFinder->handicaps()->sync($request->safe()->only('handicaps')['handicaps']);

            $skill_ids = [];
            foreach ($request->safe()->skills as $skillName) {
                $skill = Skill::firstOrCreate([
                    'name' => $skillName
                ]);
                $skill_ids[] = $skill->id;
            }
            // JobFinder と Skill の関連を作り直す
            $jobFinder->skills()->sync($skill_ids);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('success', '登録に失敗しました');
        }

        return redirect(route('job-finders.edit', $jobFinder))->with('success', $jobFinder->name .'さんを追加しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(JobFinder $jobFinder)
    {
        $jobFinder->load([
            'skills:name',
            'employmentPattern:id,name',
            'gender:id,name',
            'handicaps:id',
            'occupation:id,name',
            'works'
        ]);
        return Inertia::render('JobFinders/Edit',[
            'jobFinder' => $jobFinder,
            'employmentPatterns' => EmploymentPattern::orderBy('sort')->get(['id', 'name']),
            'genders' => Gender::orderBy('sort')->get(['id', 'name']),
            'handicaps' => Handicap::orderBy('sort')->get(['id', 'name']),
            'labels' => [
                'avatar' => array_map(
                    fn ($file) => $file->getFilename(), File::files(public_path('avatar'))
                ),
                'skill' => Skill::get(['name'])
                    ->map(fn ($skill) => $skill->name),
                'occupation' => Occupation::get(['name'])
                    ->map(fn ($occupation) => $occupation->name),
            ]
        ]);
    }

    public function update(JobFinderRequest $request, JobFinder $jobFinder)
    {
        DB::beginTransaction();
        try {
            $occupation = Occupation::firstOrCreate([
                'name' => $request->safe()->occupation
            ]);

            $attributes = $request->safe()
                ->merge(['occupation_id' => $occupation->id])
                ->except(['skills', 'occupation', 'handicaps']);
            $jobFinder->update($attributes);

            $jobFinder->handicaps()->sync($request->safe()->only('handicaps')['handicaps']);
 
            $skill_ids = [];
            foreach ($request->safe()->skills as $skillName) {
                $skill = Skill::firstOrCreate([
                    'name' => $skillName
                ]);
                $skill_ids[] = $skill->id;
            }
            // JobFinder と Skill の関連を作り直す
            $jobFinder->skills()->sync($skill_ids);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('success', '更新に失敗しました');
        }

        return redirect(route('job-finders.edit', $jobFinder))->with('success', $jobFinder->name .'さんを更新しました！');
    }

    public function destroy(JobFinder $jobFinder)
    {
        try {
            DB::transaction(function () use ($jobFinder) {
                $jobFinder->handicaps()->detach();
                $jobFinder->skills()->detach();
                $jobFinder->delete();
            });
        } catch (Exception $e) {
            return back()->with('success', $jobFinder->name .'さんの削除に失敗しました');
        }

        return back()->with('success', $jobFinder->name .'さんを削除しました！');
    }
}
