<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\core\Controller;
use Laravel\Blog\application\models\Repositories\UserRepository;
use Laravel\Blog\application\models\SessionManager;
use Laravel\Blog\application\models\User;
use Laravel\Blog\application\models\UserMapper;

class controller_login extends Controller {
    public function index(): void
    {
        $this->view->generate("login_view.php");
    }

    public static function login(string $login): void
    {
        SessionManager::set('login', $login);
        header("Location: index.php");
    }

    public static function logout(): void
    {
        // Здесь вы можете использовать методы сессии для удаления идентификатора пользователя
        SessionManager::remove('login');
    }

    public static function isLoggedIn(): bool
    {
        // Проверка, залогинен ли пользователь
        return SessionManager::has('login');
    }

    public static function getUser(): ?User
    {
        // Получение объекта пользователя, если пользователь залогинен
        if (self::isLoggedIn()) {
            $login = SessionManager::get('login');
            $userRepository = new UserRepository();
            $userRepository->getByKey($login);
        }
        return null;
    }
}