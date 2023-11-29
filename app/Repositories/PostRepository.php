<?php

namespace App\Repositories;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;
use App\Models\Post;
use App\Models\PostCategory;

class PostRepository
{
    public function getAll(){
        return Post::query()->with(['category', 'user'])->orderby('created_at', 'desc')->get();
    }

    public function getAllActive(){
        return Post::query()->with(['category', 'user', 'comments'])->where('status', 1)->orderby('created_at', 'desc')->get();
    }

    public function getAllActiveByCategoryId($categoryId){
        return Post::query()
            ->where('status', 1)
            ->whereHas('postCategory', function ($postCategory)  use ($categoryId) {
                $postCategory->where('category_id', $categoryId);
            })
            ->with(['category', 'user'])
            ->orderby('created_at', 'desc')
            ->get();
    }

    public function getByID(int $id){
        return Post::query()->with(['category', 'comments.user'])->find($id);
    }

    public function getByUserID(int $userID){
        return Post::query()->with(['category'])->where('user_id', $userID)->get();
    }

    public function delete(int $id){
        $post = Post::query()->find($id);
        if($post){
            $post->delete();
            return true;
        }
        return false;
    }

    public function create(CreatePostDTO $postData){
        $post = new Post();
        $post->fill($postData->getDataAsArray());
        $post->save();

        return $post;
    }

    public function update(UpdatePostDTO $postDTO){
        $post = Post::query()->find($postDTO->getId());
        $post->update($postDTO->getDataAsArray());

        return $post;
    }
}
