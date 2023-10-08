<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupationRequest;
use App\Models\Occupation;
use Inertia\Inertia;

class OccupationController extends Controller
{
    public function index()
    {
        $occupations = Occupation::withCount('workers')->get();
        return Inertia::render('Occupations/Index', [
            'occupations' => $occupations
        ]);
    }
 
    public function store(OccupationRequest $request)
    {
        try {
            $occupation = Occupation::firstOrCreate($request->safe()->all());
        } catch (Exception $e) {
            return back()->with('success', '追加に失敗しました');
        }
        return redirect(route('occupations.index'))->with('success', $occupation->name .'を追加しました！');
    }

    public function update(Occupation $occupation, OccupationRequest $request)
    {
        $validated = $request->safe()->all();
        try {
            $occupation->update($validated);
        } catch (Exception $e) {
            return back()->with('success', '更新に失敗しました');
        }
        return redirect(route('occupations.index'))->with('success', $occupation->name .'を更新しました！');
    }

    public function destroy(Occupation $occupation)
    {
        try {
            $occupation->delete();
        } catch (Exception $e) {
            return back()->with('success', '削除に失敗しました');
        }
        return redirect(route('occupations.index'))->with('success', $occupation->name .'を削除しました！');
    }
}
