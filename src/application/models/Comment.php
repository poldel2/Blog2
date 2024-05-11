<?php

namespace Laravel\Blog\application\models;

class Comment
{
    private $id;
    private $articleId;
    private $userId;
    private $comment;
    private $createdAt;

    public function __construct($articleId, $userId, $comment)
    {
        $this->articleId = $articleId;
        $this->userId = $userId;
        $this->comment = $comment;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getArticleId()
    {
        return $this->articleId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}