<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MainController
{
    protected $postService;
    protected $categoryService;
    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function mainPage(Request $request)
    {
        $posts = $this->postService->getAllActiveByPage(0);
        $categories = $this->categoryService->getAll();
        $categoryUsages = $categories->pluck('amount', 'id')->toArray();;
        $categoryList =  $categories->pluck('title', 'id')->toArray();
        return view('main_page', [
            'posts' => $posts,
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
