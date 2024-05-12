<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Comment;
use Laravel\Blog\application\models\Repositories\CommentsRepository;
use Laravel\Blog\application\models\SessionManager;
use PDO;

class Controller_Comment
{
    public function addComment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $articleId = $_POST['article_id'];
            $userId = $_POST['user_id'];
            $commentContent = $_POST['comment_content'];

            SessionManager::init();

            $currentTime = time();
            $lastCommentTime = SessionManager::get('last_comment_time') ? : 0;

            if ($currentTime - $lastCommentTime < 60) { // Проверка интервала
               // echo json_encode(["error" => "Вы можете отправлять комментарии не чаще чем раз в минуту"]);
                //http_response_code(429); // Too Many Requests
                header("Location: /article/view/" . $articleId);
                return;
            }

            $comment = new Comment($articleId, $userId, $commentContent);

            $commentRepository = new CommentsRepository(DB::getConnection());
            $commentRepository->save($comment);

            SessionManager::set('last_comment_time', $currentTime);
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