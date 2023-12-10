<?php

namespace App\Repositories;

use App\Models\PostLikes;

class PostLikesRepository
{
    public function like($postId, $userId)
    {
        $postLike = new PostLikes();
        $postLike->fill([
            'post_id' => $postId,
            'user_id' => $userId
        ]);
        return $postLike->save();
    }

    public function dislike($postId, $userId)
    {
        $postLike = PostLikes::query()->where('post_id', $postId)->where('user_id', $userId);
        return $postLike->delete();
    }

    public function isPostLiked($userId, $postId)
    {
        if(PostLikes::query()->where('user_id', $userId)->where('post_id', $postId)->exists())
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}
