<div class="card">
    <strong>{{ $user->name }}</strong>
    @if ($user->email)
        <span class="muted">{{ $user->email }}</span>
    @endif

    @if ($user->relationLoaded('profile') && $user->profile)
        <div class="muted">{{ $user->profile->city }}</div>
    @endif

    @if ($user->relationLoaded('posts'))
        @include('eager-loading.partials.posts-list', ['posts' => $user->posts])
    @else
        @include('eager-loading.partials.orders-list', ['orders' => $user->orders])
    @endif
</div>
