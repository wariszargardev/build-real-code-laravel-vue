<?php

use App\Http\Controllers\EagerLoadingController;
use App\Http\Middleware\LogDatabaseQueries;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(LogDatabaseQueries::class)->group(function () {
    // Day 01 · Laravel eager loading: N+1 → with() → select columns → nested relations → constrained → load() later → $with property
    Route::get('eager-loading', [EagerLoadingController::class, 'index'])->name('eager-loading');

    // Day 02 · Vue computed vs watch

    // Day 03 · Laravel form requests
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
