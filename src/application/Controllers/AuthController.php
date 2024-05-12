<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Repositories\UserRepository;
use Laravel\Blog\application\models\SessionManager;
use Laravel\Blog\application\models\User;
use Laravel\Blog\application\models\UserMapper;

class AuthController {
    public static function createSession(string $login, int $id): void
    {
        SessionManager::set('login', $login);
        SessionManager::set('user_id', $id);
        header("Location: index.php");
    }

    public static function logout(): void
    {
        // Здесь вы можете использовать методы сессии для удаления идентификатора пользователя
        SessionManager::remove('login');
        SessionManager::remove('user_id');
    }

    public static function isLoggedIn(): bool
    {
        // Проверка, залогинен ли пользователь
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