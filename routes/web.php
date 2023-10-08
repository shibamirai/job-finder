<?php

use App\Http\Controllers\JobFinderController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

Route::controller(PortfolioController::class)->group(function () {
    Route::redirect('/', 'portfolio');
    Route::get('/portfolio', 'index')->name('index');
    Route::get('/portfolio/{jobFinder}', 'show')->name('show');
});

Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/job-finders', JobFinderController::class)->except(['show']);

    Route::post('/job-finders/{jobFinder}/works', [WorkController::class, 'store'])->name('job-finders.works.store');
    Route::patch('/job-finders/{jobFinder}/works/{work}', [WorkController::class, 'update'])->name('job-finders.works.update');
    Route::delete('/job-finders/{jobFinder}/works/{work}', [WorkController::class, 'destroy'])->name('job-finders.works.destroy');

    Route::get('/occupations', [OccupationController::class, 'index'])->name('occupations.index');
    Route::post('/occupations', [OccupationController::class, 'store'])->name('occupations.store');
    Route::patch('/occupations/{occupation}', [OccupationController::class, 'update'])->name('occupations.update');
    Route::delete('/occupations/{occupation}', [OccupationController::class, 'destroy'])->name('occupations.destroy');
});

require __DIR__.'/auth.php';
