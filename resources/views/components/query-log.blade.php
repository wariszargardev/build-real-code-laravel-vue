@props(['healthyQueryLimit' => 5])

@php($executedQueries = \Illuminate\Support\Facades\DB::getQueryLog())

<section class="card query-log">
    <h2>
        Queries:
        <span @class(['query-count', 'is-healthy' => count($executedQueries) <= $healthyQueryLimit])>{{ count($executedQueries) }}</span>
    </h2>

    <details>
        <summary>Show SQL</summary>
        <ol>
            @foreach ($executedQueries as $executedQuery)
                <li><code>{{ $executedQuery['query'] }}</code> <span class="muted">({{ $executedQuery['time'] }} ms)</span></li>
            @endforeach
        </ol>
    </details>
</section>
