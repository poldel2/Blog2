<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\models\Comment;
use Laravel\Blog\application\models\Repositories\CommentsRepository;
use Laravel\Blog\Framework\DB;
use Laravel\Blog\Framework\SessionManager;
use Laravel\Blog\Framework\Validators\FormValidator;

class CommentController
{
    public function addComment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new FormValidator();
            $articleId = $_POST['article_id'];

            if (!$validator->validateField('comment', $_POST['comment_content'])) {
                header("Location: /article/view/" . $articleId);
                return;
            }
            $commentRepository = new CommentsRepository(DB::getConnection());

            $userId = $_POST['user_id'];
            $commentContent = $_POST['comment_content'];
            $commentCount = $commentRepository->getCommentsCountByUserAndArticle($userId, $articleId);
            SessionManager::init();

            $currentTime = time();
            $lastCommentTime = SessionManager::get('last_comment_time') ? : 0;

            if (($currentTime - $lastCommentTime < 60) || ($userId == 0) || ($commentCount > 3)) {
                header("Location: /article/view/" . $articleId);
                return;
            }

            $comment = new Comment($articleId, $userId, $commentContent);


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