<?php

namespace Laravel\Blog\application\models\Repositories;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Repositories\Repository;

class LikeRepository
{

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addLike($articleId, $userId)
    {
        $sql = "INSERT INTO likes (article_id, user_id) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$articleId, $userId]);
    }

    public function removeLike($articleId, $userId)
    {
        $sql = "DELETE FROM likes WHERE article_id = ? AND user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$articleId, $userId]);
    }

    public function checkLikeExists($articleId, $userId)
    {
        $sql = "SELECT COUNT(*) FROM likes WHERE article_id = ? AND user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$articleId, $userId]);
        return $stmt->fetchColumn() > 0;
    }

    public function countLikes($articleId)
    {
        $sql = "SELECT COUNT(*) FROM likes WHERE article_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$articleId]);
        return $stmt->fetchColumn();
    }
}