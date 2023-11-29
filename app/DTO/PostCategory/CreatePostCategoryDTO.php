<?php

namespace App\DTO\PostCategory;

class CreatePostCategoryDTO
{
    protected $postID;
    protected $category;

    /**
     * @param $postID
     * @param $category
     */
    public function __construct($postID, $category)
    {
        $this->postID = $postID;
        $this->category = $category;
    }

    public function setPostID($postID): void
    {
        $this->postID = $postID;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function getPostID()
    {
        return $this->postID;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getDataAsArray(): array
    {
        return [
            'post_id' => $this->postID,
            'category_id' => $this->category
        ];
    }

}
