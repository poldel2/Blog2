<?php

namespace Laravel\Blog\application\models\Repositories;


use Laravel\Blog\application\models\Article;
use PDO;

class ArticleRepository extends Repository
{
    public function getByKey($key)
    {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$key]);

        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userRow) {
            $article = new Article($userRow['title'], $userRow['content'], $userRow['user_id']);
            $article->setId($userRow['id']);
            return $article;
        } else {
            return null;
        }
    }

    public function save($entity): void
    {
        if ($entity instanceof Article) {
            $title = $entity->getTitle();
            $content = $entity->getContent();
            $user_id = $entity->getUserId();
            $stmt = $this->db->prepare("INSERT INTO Articles(user_id, title, content) VALUES(:user_id, :title, :content)");
            $stmt->execute([
                'user_id' => $user_id,
                'title' => $title,
                'content' => $content
            ]);
        }
    }

    public function delete($key)
    {
        $stmt = $this->db->prepare("Delete FROM Articles WHERE id = ?");
        $stmt->execute([$key]);
    }

    public function update($entity)
    {
        if ($entity instanceof Article) {
            $id = $entity->getId();
            $title = $entity->getTitle();
            $content = $entity->getContent();

            $stmt = $this->db->prepare("UPDATE Articles SET title = :title, content = :content WHERE id = :id");
            $stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':id' => $id
            ]);
        }
    }


    public function getArticles($page, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db->prepare("SELECT * FROM articles LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}