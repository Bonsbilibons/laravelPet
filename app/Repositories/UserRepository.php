<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\QueriesRelationships;

class UserRepository
{
    public function findById($userId)
    {
        return User::query()->find($userId);
    }

    public function topByPosts()
    {
        return User::query()->withCount(['Posts'])->orderBy('posts_count', 'desc')->get();
    }

    public function topByLikes()
    {
        return User::query()->withCount(['Likes'])->orderBy('likes_count', 'desc')->get();
    }
}
