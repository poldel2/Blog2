<?php

namespace Laravel\Blog\application\Controllers;

class LikeController
{
    public function toggleLike(int $commentId, int $userId): void
    {
        $likeRepo = new LikeRepository(DB::getConnection());
        if ($likeRepo->checkLikeExists($commentId, $userId)) {
            $likeRepo->removeLike($commentId, $userId);
        } else {
            $likeRepo->addLike($commentId, $userId);
        }
    }
}