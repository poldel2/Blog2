<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Comment;
use Laravel\Blog\application\models\Repositories\CommentsRepository;
use PDO;

class Controller_Comment
{
    public function addComment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleId = $_POST['article_id'];
            $userId = $_POST['user_id'];
            $commentContent = $_POST['comment_content'];

            $comment = new Comment($articleId, $userId, $commentContent);

            $commentRepository = new CommentsRepository(DB::getConnection());
            $commentRepository->save($comment);

            header("Location: /article/view/" . $articleId);
            exit;
        }
    }

    public function fetchComments(int $articleId, int $page): void
    {
        $repository = new CommentsRepository(DB::getConnection());
        $comments = $repository->getCommentsWithAuthor($articleId, $page);
        echo json_encode($comments);
    }


}