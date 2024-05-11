<?php

namespace Laravel\Blog\application\models;

class Article
{
    private $id;
    private $title;
    private $content;

    private $user_id;
    public function __construct($title, $content, $user_id, $id = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}