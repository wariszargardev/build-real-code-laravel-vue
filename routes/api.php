<?php

use Illuminate\Support\Facades\Route;

Route::get('/demo', fn () => ['app' => config('app.name'), 'days' => []])->name('api.demo.index');
