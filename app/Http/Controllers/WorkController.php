<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkRequest;
use App\Models\Work;

class WorkController extends Controller
{
    public function store(WorkRequest $request, string $jobFinder)
    {
        $attributes = array_merge($request->safe()->all(), ['job_finder_id' => $jobFinder,]);
        Work::create($attributes);
        return redirect(route('job-finders.edit', $jobFinder))->with('success', 'ポートフォリオを追加しました！');
    }

    public function update(WorkRequest $request, string $jobFinder, Work $work)
    {
        $validated = $request->safe()->all();
        $work->update($validated);
        return redirect(route('job-finders.edit', $jobFinder))->with('success', 'ポートフォリオを更新しました！');
    }

    public function destroy(string $jobFinder, Work $work)
    {
        $work->delete();
        return redirect(route('job-finders.edit', $jobFinder))->with('success', 'ポートフォリオを削除しました！');
    }
}
