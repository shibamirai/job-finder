<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkRequest;
use App\Models\Work;

class WorkController extends Controller
{
    public function store(WorkRequest $request, string $jobFinder)
    {
        $attributes = array_merge($request->safe()->all(), ['job_finder_id' => $jobFinder,]);
        try {
            Work::create($attributes);
        } catch (Exception $e) {
            return back()->with('success', '追加に失敗しました');
        }
        return redirect(route('job-finders.edit', $jobFinder))->with('success', 'ポートフォリオを追加しました！');
    }

    public function update(WorkRequest $request, string $jobFinder, Work $work)
    {
        $validated = $request->safe()->all();
        try {
            $work->update($validated);
        } catch (Exception $e) {
            return back()->with('success', '更新に失敗しました');
        }
        return redirect(route('job-finders.edit', $jobFinder))->with('success', 'ポートフォリオを更新しました！');
    }

    public function destroy(string $jobFinder, Work $work)
    {
        try {
            $work->delete();
        } catch (Exception $e) {
            return back()->with('success', '削除に失敗しました');
        }
        return redirect(route('job-finders.edit', $jobFinder))->with('success', 'ポートフォリオを削除しました！');
    }
}
