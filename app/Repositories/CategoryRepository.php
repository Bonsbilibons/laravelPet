<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::query()->with(['posts'])->get();
    }

    public function getPyPostId($postId)
    {
        return Category::query()->where('post_id', $postId)->get();
    }
}
