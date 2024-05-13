<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Repositories\LikeRepository;

class LikeController
{
    public function toggleLike(int $articleId, int $userId): void
    {
        $likeRepo = new LikeRepository(DB::getConnection());
        if ($userId == 0)
        {
            echo json_encode(['success' => false, 'message' => 'No login']);
            return;
        }
        if ($likeRepo->checkLikeExists($articleId, $userId)) {
            $likeRepo->removeLike($articleId, $userId);
            echo json_encode(['success' => true, 'message' => 'Like removed']);
        } else {
            $likeRepo->addLike($articleId, $userId);
            echo json_encode(['success' => true, 'message' => 'Like added']);
        }
    }

    public function countLikes($articleId): void
    {
        $likeRepo = new LikeRepository(DB::getConnection());
        $likesCount = $likeRepo->countLikes($articleId);
        echo json_encode(['likesCount' => $likesCount]);
    }
}