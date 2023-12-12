<?php

namespace App\Http\Controllers\Backend\User;

use App\Events\FollowEvent;
use App\Http\Controllers\Controller;

use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserCommonController extends Controller
{
    private $userService;
    private $postService;

    /**
     * @param $userService
     * @param $postService
     */
    public function __construct(UserService $userService, PostService $postService)
    {
        $this->userService = $userService;
        $this->postService = $postService;
    }


    public function publicProfile(Request $request, $userId)
    {
        $posts = $this->postService->getByUserIdAndPage($userId, 0);
        $user = $this->userService->findByUserId($userId);
        return view('backend.user.user_public_page', [
            'user'=>$user,
            'posts'=>$posts,
            'currentPage' => 0
            ]);
    }

    public function publicProfileAndPostsPage(Request $request, $userId, $page)
    {
        $posts = $this->postService->getByUserIdAndPage($userId, $page);
        $user = $this->userService->findByUserId($userId);
        return view('backend.user.user_public_page', [
            'user'=>$user,
            'posts'=>$posts,
            'currentPage' => $page
        ]);
    }

    public function followOnUser(Request $request)
    {
        event(new FollowEvent((int)$request->user()->id, $request->user()->name, (int)$request->authorId ));
        return $this->userService->followOnUser($request->authorId, $request->followerId);
    }

    public function unfollowOnUser(Request $request)
    {
        return $this->userService->unfollowOnUser($request->authorId, $request->followerId);
    }

    public function isFollowedOnUser(Request $request)
    {
        return $this->userService->isFollowedOnUser($request->authorId, $request->followerId);
    }
}
