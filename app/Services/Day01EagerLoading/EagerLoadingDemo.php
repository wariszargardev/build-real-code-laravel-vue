<?php

namespace App\Services\Day01EagerLoading;

use App\Models\User;
use App\Support\QueryRecorder;

class EagerLoadingDemo
{
    public function __construct(private QueryRecorder $queryRecorder) {}

    /**
     * Part 1: with() but only the columns you need.
     *
     * before → every column of users and orders
     * after  → only users.id, users.name and orders.id, user_id, total
     * gotcha → foreign key left out, so every user's orders come back empty
     *
     * @return array{part: string, title: string, mode: string, query_count: int, queries: list<array<string, mixed>>, payload_bytes: int, users_with_orders: int, sample: array<int, mixed>}
     */
    public function selectColumns(string $mode): array
    {
        $recording = $this->queryRecorder->record("day-01 part-01 {$mode}", fn () => match ($mode) {
            'after' => User::with('orders:id,user_id,total')->get(['id', 'name']),
            'gotcha' => User::with('orders:id,total')->get(['id', 'name']),
            default => User::with('orders')->get(),
        });

        $users = $recording['result'];

        return [
            'part' => 'day-01/part-01',
            'title' => 'with() but only the columns you need',
            'mode' => $mode,
            'query_count' => $recording['query_count'],
            'queries' => $recording['queries'],
            'payload_bytes' => strlen($users->toJson()),
            'users_with_orders' => $users->filter(fn (User $user): bool => $user->orders->isNotEmpty())->count(),
            'sample' => $users->take(2)->values()->toArray(),
        ];
    }
}
