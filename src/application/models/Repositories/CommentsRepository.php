<?php

namespace Laravel\Blog\application\models\Repositories;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Comment;
use Laravel\Blog\application\models\Repositories\Repository;
use PDO;

class CommentsRepository extends Repository
{

    public function getByKey($key)
    {
        // TODO: Implement getByKey() method.
    }

    public function save($entity): void
    {
        if ($entity instanceof Comment) {

            $articleId = $entity->getArticleId();
            $userId = $entity->getUserId();
            $commentContent = $entity->getComment();

            $db = DB::getConnection();
            $stmt = $db->prepare("INSERT INTO comments (article_id, user_id, comment) VALUES (?, ?, ?)");
            $stmt->execute([$articleId, $userId, $commentContent]);
        }
    }

    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    public function update($entity)
    {
        // TODO: Implement update() method.
    }

    public function getCommentsWithAuthor($articleId, $page): bool|array
    {
        $limit = 5;
        $offset = $limit * ($page - 1);

        $stmt = $this->db->prepare("
        SELECT c.comment, u.name 
        FROM comments c 
        JOIN users u ON c.user_id = u.id 
        WHERE c.article_id = :articleId 
        ORDER BY c.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
        $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}