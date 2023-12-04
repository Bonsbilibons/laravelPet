<?php

namespace App\DTO\Post;

class UpdatePostDTO
{
    protected $id;
    protected $userID;
    protected $title;
    protected $description;
    protected $status;
    protected $category;
    protected $newImages;
    protected $oldImages;

    /**
     * @param $id
     * @param $userID
     * @param $title
     * @param $description
     * @param $status
     * @param $category
     * @param $newImages
     * @param $oldImages
     */
    public function __construct($id, $userID, $title, $description, $status, $category, $oldImages, $newImages)
    {
        $this->id = $id;
        $this->userID = $userID;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->category = $category;
        $this->newImages = $newImages;
        $this->oldImages = $oldImages;
    }

    public function setId($id): void
    {
        $this->id = $id;
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

    public function getId()
    {
        return $this->id;
    }

    public function setNewImages(array $newImages): void
    {
        $this->newImages = $newImages;
    }

    public function setOldImages(array $oldImages): void
    {
        $this->oldImages = $oldImages;
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
        return $this->category;
    }

    public function getNewImages()
    {
        return $this->newImages;
    }
    public function getOldImages()
    {
        return $this->oldImages;
    }

    public function getDataAsArray()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userID,
            'title' => $this->title,
            'description' => $this->description ,
            'status' => $this->status
        ];
    }
}
