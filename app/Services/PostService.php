<?php

namespace App\Services;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;

use App\DTO\PostCategory\CreatePostCategoryDTO;
use App\DTO\PostCategory\UpdatePostCategoryDTO;

use App\DTO\PostImages\AddImagesDTO;
use App\DTO\PostImages\UpdateImagesDTO;

use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\PostImagesRepository;
use App\Repositories\PostLikesRepository;



class PostService
{
    /** @var PostRepository  */
    private $postRepository;
    private $postCategoryRepository;
    private  $postImagesRepository;
    private $postLikesRepository;
    public function __construct(
        PostRepository $postRepository,
        PostCategoryRepository $postCategoryRepository,
        PostImagesRepository $postImagesRepository,
        PostLikesRepository $postLikesRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->postCategoryRepository = $postCategoryRepository;
        $this->postImagesRepository = $postImagesRepository;
        $this->postLikesRepository = $postLikesRepository;
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

        $destinationPath = public_path('assets/images/postsImages/' . $id);
        if(file_exists($destinationPath))
        {
            $attachedFiles = scandir($destinationPath);
            foreach ($attachedFiles as $file)
                {
                    if($file != '.' && $file != '..') {
                        $currentPath = public_path('assets/images/postsImages/' . $id . '/' . $file);
                        unlink($currentPath);
                    }
                }
            rmdir($destinationPath);
        }
        $this->postImagesRepository->deleteByPostId($id);

        return $this->postRepository->delete($id);
    }

    public function create(CreatePostDTO $postDTO){
        $post = $this->postRepository->create($postDTO);

        $createPostCategoryDTO = new CreatePostCategoryDTO(
            $post->id,
            $postDTO->getCategory()
        );
        $this->postCategoryRepository->create($createPostCategoryDTO);

        $destinationPath = public_path('assets/images/postsImages/' . $post->id);
        mkdir($destinationPath, 0777, true);
        foreach ($postDTO->getImages() as $image)
        {
            $imageName = $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
        };
        $addPostImagesDTO = new AddImagesDTO(
            $post->id,
            $postDTO->getImages()
        );
        $this->postImagesRepository->addImages($addPostImagesDTO);

        return true;
    }

    public function update(UpdatePostDTO $postDTO){
        $updatePostCategoryDTO = new UpdatePostCategoryDTO(
            $postDTO->getId(),
            $postDTO->getCategory()
        );
        $this->postCategoryRepository->update($updatePostCategoryDTO);

        $updateImagesDTO = new UpdateImagesDTO(
            $postDTO->getId(),
            $postDTO->getOldImages(),
            $postDTO->getNewImages()
        );
        $destinationPath = public_path('assets/images/postsImages/' . $updateImagesDTO->getPostId());
        if($updateImagesDTO->getOldImages()) {
            $postInDB = $this->postImagesRepository->getByPostId($postDTO->getId());
            foreach ($postInDB as $oldImage) {
                $toDelete = true;
                foreach ($updateImagesDTO->getOldImages() as $image) {
                    if ($oldImage->title == $image) {
                        $toDelete = false;
                        break;
                    };
                };
                if ($toDelete == true) {
                    $oldImage->delete();
                    $currentPath = public_path('assets/images/postsImages/' . $updateImagesDTO->getPostId() . '/' . $oldImage->title);
                    unlink($currentPath);
                };
            };
        } else
        {
            if(file_exists($destinationPath))
            {
                $this->postImagesRepository->deleteByPostId($updateImagesDTO->getPostId());
                $attachedFiles = scandir($destinationPath);
                foreach ($attachedFiles as $file)
                {
                    if($file != '.' && $file != '..') {
                        $currentPath = public_path('assets/images/postsImages/' . $updateImagesDTO->getPostId() . '/' . $file);
                        unlink($currentPath);
                    }
                }
            }
        }
        if($updateImagesDTO->getNewImages()) {
            if(!file_exists($destinationPath))
            {
                mkdir($destinationPath, 0777, true);
            }
            foreach ($postDTO->getNewImages() as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move($destinationPath, $imageName);
            };
            $this->postImagesRepository->updateImages($updateImagesDTO);
        }

        return $this->postRepository->update($postDTO);
    }

    public function likePost($postId, $userId)
    {
        return $this->postLikesRepository->like($postId, $userId);
    }
    public function dislikePost($postId, $userId)
    {
        return $this->postLikesRepository->dislike($postId, $userId);
    }
}
