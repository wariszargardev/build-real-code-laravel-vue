<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogDatabaseQueries
{
    /**
     * Keeps every query of the request so the page can show them, then writes them to storage/logs/demo.log.
     */
    public function handle(Request $request, Closure $next): Response
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $response = $next($request);

        $executedQueries = DB::getQueryLog();

        Log::channel('demo')->info($request->path(), [
            'query_count' => count($executedQueries),
            'queries' => array_column($executedQueries, 'query'),
        ]);

        DB::disableQueryLog();

        return $response;
    }
}
