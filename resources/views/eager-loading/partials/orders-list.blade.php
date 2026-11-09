<ul>
    @foreach ($orders as $order)
        <li>
            #{{ $order->id }} · {{ number_format($order->total, 2) }}
            @if ($order->status)
                <span class="muted">· {{ $order->status->value }}</span>
            @endif
        </li>
    @endforeach
</ul>
