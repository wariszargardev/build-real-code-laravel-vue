<?php

use App\Models\Order;
use App\Models\User;

beforeEach(function () {
    $this->users = User::factory()->count(6)->has(Order::factory()->count(2))->create();
});

test('the eager loading page lists every user with their orders', function () {
    $response = $this->get(route('eager-loading'))->assertOk();

    $this->users->each(fn (User $user) => $response->assertSee($user->name));
});

test('the active N+1 example runs one query for users plus one per user', function () {
    $expectedQueryCount = 1 + $this->users->count();

    $this->get(route('eager-loading'))
        ->assertOk()
        ->assertSee('<span class="query-count">'.$expectedQueryCount.'</span>', false);
});
