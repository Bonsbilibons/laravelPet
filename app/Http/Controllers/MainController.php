<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\UserService;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



use PHPUnit\Framework\Constraint\Count;
use Yajra\DataTables\DataTables;

class MainController
{
    protected $postService;
    protected $categoryService;
    protected $userService;
    public function __construct(PostService $postService, CategoryService $categoryService, UserService $userService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function mainPage(Request $request)
    {
        $posts = $this->postService->getAllActiveByPage(0);
        $categories = $this->categoryService->getAll();
        $categoryUsages = $categories->pluck('amount', 'id')->toArray();;
        $categoryList =  $categories->pluck('title', 'id')->toArray();
        $topUsersByPosts = $this->userService->topByPosts(5);
        $topUsersByLikes = $this->userService->topByLikes(5);
        $topUsersByFollowers = $this->userService->topByFollowers(5);

        return view('main_page', [
            'posts' => $posts,
            'topUsersByPosts' =>$topUsersByPosts,
            'topUsersByLikes' => $topUsersByLikes,
            'topUsersByFollowers' => $topUsersByFollowers,
            'categoryList' => $categoryList,
            'categoryUsages' => $categoryUsages,
            'currentPage' => 0
        ]);
    }

    public function mainPageById(Request $request, $pageId)
    {
        $posts = $this->postService->getAllActiveByPage($pageId);
        $categories = $this->categoryService->getAll();
        $categoryUsages = $categories->pluck('amount', 'id')->toArray();;
        $categoryList =  $categories->pluck('title', 'id')->toArray();
        return view('main_page', [
            'posts' => $posts,
            'categoryList' => $categoryList,
            'categoryUsages' => $categoryUsages,
            'currentPage' => $pageId
        ]);
    }

    public function mainByCategoryAndPageID(Request $request, $category, $pageId)
    {
        $categories = $this->categoryService->getAll();
        $categoryUsages = $categories->pluck('amount', 'id')->toArray();;
        $categoryList =  $categories->pluck('title', 'id')->toArray();

        $categoriesList =  $categories->pluck('id', 'title')->toArray();
        $posts = $this->postService->getAllActiveByCategoryAndPage($categoriesList["$category"], $pageId);
        return view('main_page_by_category', [
            'posts' => $posts,
            'categoryList' => $categoryList,
            'categoryUsages' => $categoryUsages,
            'currentPage' => $pageId,
            'currentCategory' => $category
        ]);
    }
}
