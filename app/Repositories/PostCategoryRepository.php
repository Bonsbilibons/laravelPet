<?php

namespace App\Repositories;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;
use App\DTO\PostCategory\CreatePostCategoryDTO;
use App\DTO\PostCategory\UpdatePostCategoryDTO;
use App\Models\Post;
use App\Models\PostCategory;

class PostCategoryRepository
{
    public function delete(int $postID){
        $postCategory = PostCategory::query()->where('post_id', $postID);
        if($postCategory){
            $postCategory->delete();
            return true;
        }
        return false;
    }

    public function create(CreatePostCategoryDTO $postData){
        $postCategory = new PostCategory();
        $postCategory->fill($postData->getDataAsArray());
        $postCategory->save();

        return $postCategory;
    }

    public function update(UpdatePostCategoryDTO $postDTO){
        $postCategory = PostCategory::query()->where('post_id', $postDTO->getPostID());
        $postCategory->update($postDTO->getDataAsArray());

        return $postCategory;
    }


    public function getByCategoryID($categoryID)
    {
        return PostCategory::query()->where('category_id', $categoryID);
    }
}
