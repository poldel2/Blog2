<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\models\Repositories\UserRepository;
use Laravel\Blog\application\models\User;
use Laravel\Blog\application\models\UserMapper;
use Laravel\Blog\Framework\DB;
use Laravel\Blog\Framework\SessionManager;

class AuthController {
    public static function createSession(string $login, int $id): void
    {
        SessionManager::set('login', $login);
        SessionManager::set('user_id', $id);
        header("Location: index.php");
    }

    public static function logout(): void
    {
        SessionManager::remove('login');
        SessionManager::remove('user_id');
    }

    public static function isLoggedIn(): bool
    {
        return SessionManager::has('user_id');
    }

    public static function getUser(): ?User
    {
        if (self::isLoggedIn()) {
            $id = SessionManager::get('user_id');
            $userRepository = new UserRepository(DB::getConnection());
            return $userRepository->getByKey($id);
        }
        return null;
    }
}