<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class Day01EagerLoadingSeeder extends Seeder
{
    public const USERS = 50;

    public const ORDERS_PER_USER = 5;

    public const POSTS_PER_USER = 3;

    public const COMMENTS_PER_POST = 3;

    public const REPLIES_PER_COMMENT = 2;

    /**
     * Users with a profile, orders, and posts → comments → replies, for the day 01 eager loading demos.
     */
    public function run(): void
    {
        $users = User::factory()->count(self::USERS)->create();

        $users->each(function (User $user) use ($users): void {
            Profile::factory()->for($user)->create();
            Order::factory()->count(self::ORDERS_PER_USER)->for($user)->create();

            Post::factory()->count(self::POSTS_PER_USER)->for($user, 'author')->create()
                ->each(function (Post $post) use ($users): void {
                    Comment::factory()->count(self::COMMENTS_PER_POST)
                        ->for($post)
                        ->state(fn (): array => ['user_id' => $users->random()->id])
                        ->create()
                        ->each(fn (Comment $comment) => Reply::factory()->count(self::REPLIES_PER_COMMENT)
                            ->for($comment)
                            ->state(fn (): array => ['user_id' => $users->random()->id])
                            ->create());
                });
        });
    }
}
