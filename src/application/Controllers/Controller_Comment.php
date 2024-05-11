<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use PDO;

class Controller_Comment
{
    public function addComment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleId = $_POST['article_id'];
            $userId = $_POST['user_id'];
            $commentContent = $_POST['comment_content'];

            echo "  ";
            echo $userId;
            $db = DB::getConnection();
            $stmt = $db->prepare("INSERT INTO comments (article_id, user_id, comment) VALUES (?, ?, ?)");
            $stmt->execute([$articleId, $userId, $commentContent]);

            header("Location: /article/view/" . $articleId);
            exit;
        }
    }

    public function fetchComments(int $articleId, int $page): void
    {
        $limit = $page == 0 ? 2 : 10; // Первая загрузка 2 комментария, последующие по 10
        $offset = $page * $limit;


        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM comments WHERE article_id = :article_id LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // var_dump($comments);
        echo json_encode($comments);

    }


}