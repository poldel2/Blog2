<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\SessionManager;
use Laravel\Blog\Framework\core\Controller;

class Controller_Login extends Controller
{
    public function index(): void
    {
        SessionManager::init();
        AuthController::logout();
        $this->view->generate("login_view.php", "template_view.php");
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получение данных из POST-запроса
            $name = $_POST['name'];
            $password = $_POST['password'];

            if (empty($name) || empty($password)) {
                echo "Введите имя пользователя и пароль";
                return;
            }

            $db = DB::getConnection();

            // Поиск пользователя в базе данных по логину
            $query = "SELECT id, name, password FROM users WHERE name = :name";
            $statement = $db->prepare($query);
            $statement->execute(['name' => $name]);
            $user = $statement->fetch();
            if ($user) {
                $hash = $user['password'];
                if (password_verify($password, $hash)) {
                    SessionManager::init();
                    AuthController::createSession($user['name'], $user['id']);

                    header("Location: /main");
                    exit();
                } else {
                    header("Location: /login");
                    echo "Ошибка входа. Проверьте правильность логина и пароля.";
                    echo $user['password'];
                }
            } else {
                header("Location: /login");
                echo "Ошибка входа. Проверьте правильность логина и пароля.";
            }
        }
    }

}