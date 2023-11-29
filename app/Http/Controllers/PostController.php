<?php

namespace App\Http\Controllers;

use App\Services\PostCommentService;
use App\Services\PostService;
use Illuminate\Http\Request;

use App\DTO\PostComment\LeaveCommentDTO;

class PostController
{
    protected $postService;
    protected $postCommentService;

    public function __construct(PostService $postService, PostCommentService $postCommentService)
    {
        $this->postService = $postService;
        $this->postCommentService = $postCommentService;
    }

    public function postById(Request $request, $postId)
    {
        $post = $this->postService->getByID($postId);
        return view('post_page', [
            'post' => $post
        ]);
    }

    public function leaveComment(Request $request)
    {
        $leaveCommentDTO = new LeaveCommentDTO(
            $request->post_id,
            $request->user()->id,
            $request->comment
        );
        $this->postCommentService->leaveComment($leaveCommentDTO);
        return redirect('post/' . $request->post_id);
    }
}
