<?php

namespace App\Services;

use App\DTO\PostComment\LeaveCommentDTO;

use App\Repositories\PostCommentRepository;

class PostCommentService
{
    private $postCommentRepository;

    public function __construct(PostCommentRepository $postCommentRepository)
    {
        $this->postCommentRepository = $postCommentRepository;
    }

    public function leaveComment(LeaveCommentDTO $leaveCommentDTO)
    {
        $this->postCommentRepository->leaveComment($leaveCommentDTO);
    }
}
