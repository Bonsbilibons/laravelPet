<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\PostCategoryRepository;

class CategoryService
{
    private $categoryRepository;
    private $postCategoryRepository;

    /**
     * @param $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository,  PostCategoryRepository $postCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postCategoryRepository = $postCategoryRepository;
    }


    public function getAll()
    {
        $categories = $this->categoryRepository->getAll();
        foreach ($categories as $category) {
            $count = $category->posts->count();
            $category->amount = $count;
        }

        return $categories;
    }

    public function getPyPostId($postId)
    {
        return $this->categoryRepository->getPyPostId($postId);
    }
}
