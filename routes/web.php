<?php

use App\Http\Controllers\JobFinderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(JobFinderController::class)->group(function () {
    Route::redirect('/', 'job-finders');
    Route::get('job-finders', 'index')->name('index');
    Route::get('job-finders/{id}', 'show')->name('show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
