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
        $occupation = Occupation::firstOrCreate($request->safe()->all());
        return redirect(route('occupations.index'))->with('success', $occupation->name .'を追加しました！');
    }

    public function update(Occupation $occupation, OccupationRequest $request)
    {
        $validated = $request->safe()->all();
        $occupation->update($validated);
        return redirect(route('occupations.index'))->with('success', $occupation->name .'を更新しました！');
    }

    public function destroy(Occupation $occupation)
    {
        $occupation->delete();
        return redirect(route('occupations.index'))->with('success', $occupation->name .'を削除しました！');
    }
}
