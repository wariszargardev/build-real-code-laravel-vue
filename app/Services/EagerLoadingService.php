<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EagerLoadingService
{
    private const USERS_PER_PAGE = 20;

    private const LATEST_POSTS_LIMIT = 20;

    /**
     * @return Collection<int, User>|LengthAwarePaginator<int, User>
     */
    public function getUsers(): Collection|LengthAwarePaginator
    {
        // N+1: without with(), the view runs 1 query for users + 1 per user for orders
        return User::all();

        // with(): users and their orders in 2 queries
        // return User::with('orders')->get();

        // with() select columns: only the columns you need, keep the foreign key user_id
        // return User::with('orders:id,user_id,total')->get(['id', 'name']);

        // with() nested relations: users → posts → comments → replies, one query per level
        // return User::with('posts.comments.replies')->get();

        // with() constrained: filter the relation inside with()
        // return User::with(['orders' => fn ($query) => $query->where('status', 'paid')->latest()])->get();

        // load() later: eager load after the query, loadMissing() skips what is already loaded
        // $users = User::paginate(self::USERS_PER_PAGE);
        // $users->load('orders');
        // $users->loadMissing('profile');
        //
        // return $users;
    }

    /**
     * $with default property: uncomment protected $with = ['author'] in App\Models\Post.
     *
     * @return Collection<int, Post>
     */
    public function getLatestPosts(): Collection
    {
        return Post::latest()->take(self::LATEST_POSTS_LIMIT)->get();

        // without(): skip the default author when it is not needed
        // return Post::without('author')->latest()->take(self::LATEST_POSTS_LIMIT)->get();
    }
}
