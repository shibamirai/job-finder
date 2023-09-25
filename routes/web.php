<?php

use App\Http\Controllers\JobFinderController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

Route::controller(PortfolioController::class)->group(function () {
    Route::redirect('/', 'portfolio');
    Route::get('/portfolio', 'index')->name('index');
    Route::get('/portfolio/{id}', 'show')->name('show');
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
});

require __DIR__.'/auth.php';
