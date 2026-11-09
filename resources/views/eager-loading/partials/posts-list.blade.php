<ul>
    @foreach ($posts as $post)
        <li>
            {{ $post->title }}
            <span class="muted">
                · {{ $post->comments->count() }} comments
                · {{ $post->comments->sum(fn ($comment) => $comment->replies->count()) }} replies
            </span>
        </li>
    @endforeach
</ul>
