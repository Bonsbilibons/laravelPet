<?php

namespace App\Repositories;


use App\DTO\PostComment\LeaveCommentDTO;

use App\Models\PostComments;

class PostCommentRepository
{
    public function leaveComment(LeaveCommentDTO $leaveCommentDTO){
        PostComments::query()->create($leaveCommentDTO->getDataAsArray());
    }
}
