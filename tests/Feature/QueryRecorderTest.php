<?php

use App\Models\User;
use App\Support\QueryRecorder;

beforeEach(function () {
    $this->recorder = app(QueryRecorder::class);
});

test('it records every query the callback runs', function () {
    User::factory()->count(3)->create();

    $recording = $this->recorder->record('test', fn () => User::all()->count());

    expect($recording['result'])->toBe(3)
        ->and($recording['query_count'])->toBe(1)
        ->and($recording['queries'][0]['sql'])->toContain('select * from "users"');
});

test('the demo api index responds', function () {
    $this->getJson('/api/demo')
        ->assertOk()
        ->assertJson(['app' => config('app.name')]);
});
