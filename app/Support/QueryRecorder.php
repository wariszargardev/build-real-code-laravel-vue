<?php

namespace App\Support;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QueryRecorder
{
    /**
     * Run the callback and capture every SQL query it fires.
     *
     * @return array{result: mixed, query_count: int, queries: list<array{sql: string, bindings: array<int, mixed>, time_ms: float}>}
     */
    public function record(string $label, Closure $callback): array
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $result = $callback();

        $queries = array_map(fn (array $query): array => [
            'sql' => $query['query'],
            'bindings' => $query['bindings'],
            'time_ms' => $query['time'],
        ], DB::getQueryLog());

        DB::disableQueryLog();

        Log::channel('demo')->info($label, [
            'query_count' => count($queries),
            'queries' => array_column($queries, 'sql'),
        ]);

        return [
            'result' => $result,
            'query_count' => count($queries),
            'queries' => $queries,
        ];
    }
}
