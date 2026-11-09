<?php

use App\Http\Controllers\Demo\Day01EagerLoadingController;
use Illuminate\Support\Facades\Route;

Route::get('/demo', fn () => [
    'app' => config('app.name'),
    'days' => [
        'day-01' => [
            'part-01' => url('/api/day-01/part-01?mode=before|after|gotcha'),
        ],
    ],
])->name('api.demo.index');

Route::prefix('day-01')->name('api.day-01.')->controller(Day01EagerLoadingController::class)->group(function () {
    Route::get('/part-01', 'selectColumns')->name('part-01');
});
