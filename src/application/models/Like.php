<?php

namespace Laravel\Blog\application\models;

class Like
{
    private $id;
    private $userId;
    private $articleId;

    public function __construct($userId, $articleId)
    {
        $this->id = $userId;
        $this->articleId = $articleId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getArticleId()
    {
        return $this->articleId;
    }
}