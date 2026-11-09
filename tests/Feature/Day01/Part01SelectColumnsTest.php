<?php

use App\Models\Order;
use App\Models\User;

beforeEach(function () {
    User::factory()->count(3)->has(Order::factory()->count(2))->create();
});

test('before loads every column in two queries', function () {
    $response = $this->getJson('/api/day-01/part-01?mode=before')->assertOk();

    expect($response->json('query_count'))->toBe(2)
        ->and($response->json('users_with_orders'))->toBe(3)
        ->and($response->json('sample.0'))->toHaveKey('email')
        ->and($response->json('sample.0.orders.0'))->toHaveKeys(['notes', 'meta', 'shipping_address']);
});

test('after selects only the needed columns and sends less data', function () {
    $before = $this->getJson('/api/day-01/part-01?mode=before')->json();
    $after = $this->getJson('/api/day-01/part-01?mode=after')->assertOk()->json();

    expect($after['query_count'])->toBe(2)
        ->and($after['users_with_orders'])->toBe(3)
        ->and(array_keys($after['sample'][0]))->toBe(['id', 'name', 'orders'])
        ->and(array_keys($after['sample'][0]['orders'][0]))->toBe(['id', 'user_id', 'total'])
        ->and($after['payload_bytes'])->toBeLessThan($before['payload_bytes']);
});

test('gotcha: leaving out the foreign key returns empty orders', function () {
    $response = $this->getJson('/api/day-01/part-01?mode=gotcha')->assertOk();

    expect($response->json('users_with_orders'))->toBe(0);
});

test('an unknown mode is rejected', function () {
    $this->getJson('/api/day-01/part-01?mode=fast')->assertUnprocessable();
});
