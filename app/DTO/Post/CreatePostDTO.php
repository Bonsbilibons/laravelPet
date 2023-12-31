<?php

namespace App\DTO\Post;

class CreatePostDTO
{
    protected $userID;
    protected $title;
    protected $description;
    protected $status;
    protected $category;
    protected $images;

    public function __construct($userID, $title, $description, $status, $category, $images)
    {
        $this->userID = $userID;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->category = $category;
        $this->images = $images;
    }

    public function setUserId(int $userID): void
    {
        $this->userID = $userID;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }



    public function getUserId()
    {
        return $this->userID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCategory()
    {
        return (int)$this->category;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function getDataAsArray(): array
    {
        return [
            'user_id' => $this->userID,
            'title' => $this->title,
            'description' => $this->description ,
            'status' => $this->status
        ];
    }
}
