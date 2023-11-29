<?php

namespace App\DTO\PostComment;

class LeaveCommentDTO
{
    protected $postId;
    protected $userId;
    protected $comment;

    /**
     * @param $postId
     * @param $userId
     * @param $comment
     */
    public function __construct($postId, $userId, $comment)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->comment = $comment;
    }

    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getDataAsArray()
    {
        return [
            'post_id' => $this->postId,
            'user_id' => $this->userId,
            'comment' => $this->comment
        ];
    }

}
