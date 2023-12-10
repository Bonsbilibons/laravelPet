<?php

namespace App\Repositories;

use App\Models\UserFollowers;

class UserFollowersRepository
{
    public function followOnUser($authorId, $followerId)
    {
        return UserFollowers::query()->create([
            'author_id' => $authorId,
            'follower_id' => $followerId
        ]);
    }
    public function unfollowOnUser($authorId, $followerId)
    {
        return UserFollowers::query()->where('author_id',$authorId)->where('follower_id',$followerId)->delete();
    }
    public function isFollowedOnUser($authorId, $followerId)
    {
        if(UserFollowers::query()->where('author_id',$authorId)->where('follower_id',$followerId)->exists())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
