<?php

namespace App\Services;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;

use App\DTO\PostCategory\CreatePostCategoryDTO;
use App\DTO\PostCategory\UpdatePostCategoryDTO;

use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;


class PostService
{
    /** @var PostRepository  */
    private $postRepository;
    private $postCategoryRepository;
    public function __construct(PostRepository $postRepository, PostCategoryRepository $postCategoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function getAll(){
        return $this->postRepository->getAll();
    }

    public function getAllActiveByPage($page){
        return $this->postRepository->getAllActive()
            ->skip($page * 10)
            ->take(10);
    }

    public function getAllActiveByCategoryAndPage($categoryId, $page){
        return $this->postRepository->getAllActiveByCategoryId($categoryId)
            ->skip($page * 10)
            ->take(10);
    }

    public function getByID(int $id){
        return $this->postRepository->getByID($id);
    }

    public function getByUserID(int $userID){
        return $this->postRepository->getByUserID($userID);
    }

    public function delete(int $id){
        $this->postCategoryRepository->delete($id);
        return $this->postRepository->delete($id);
    }

    public function create(CreatePostDTO $postDTO){

        $post = $this->postRepository->create($postDTO);

        $createPostCategoryDTO = new CreatePostCategoryDTO(
            $post->id,
            $postDTO->getCategory()
        );

        $this->postCategoryRepository->create($createPostCategoryDTO);

        return true;
    }

    public function update(UpdatePostDTO $postDTO){
        $updatePostCategoryDTO = new UpdatePostCategoryDTO(
            $postDTO->getId(),
            $postDTO->getCategory()
        );
        $this->postCategoryRepository->update($updatePostCategoryDTO);

        return $this->postRepository->update($postDTO);
    }
}
