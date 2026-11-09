@extends('layouts.demo')

@section('title', 'Eager loading')

@section('content')
    <h1>Day 01 · Laravel eager loading</h1>

    <div class="grid">
        @isset($users)
            @each('eager-loading.partials.user-card', $users, 'user')
        @endisset

        @isset($posts)
            @each('eager-loading.partials.post-card', $posts, 'post')
        @endisset
    </div>
@endsection
