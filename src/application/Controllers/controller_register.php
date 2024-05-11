<?php


namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\core\Controller;
use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Repositories\UserRepository;
use Laravel\Blog\application\models\SessionManager;
use Laravel\Blog\application\models\UserDTO;

class controller_register extends Controller
{
    function index(): void
    {
        $this->view->generate('register_view.php');
    }

    function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получение данных из POST-запроса
            $username = $_POST['name'];
            $email = $_POST['email'];
            $password_1 = $_POST['password'];
            $password_2 = $_POST['password_confirmation'];

            // Валидация данных (например, проверка на пустые поля, совпадение паролей и т. д.)
            if (empty($username) || empty($email) || empty($password_1) || empty($password_2)) {
                echo "Заполните все поля";
                return;
            }

            if ($password_1 !== $password_2) {
                echo "Пароли не совпадают";
                return;
            }

            $db = DB::getConnection();

            // Создание объекта пользователя
            $userRepository = new UserRepository($db);

            $user = new UserDTO($username, $email, $password_1);

            $userRepository->save($user);

            // Вывод сообщения об успешной регистрации
            echo "Регистрация прошла успешно";

            SessionManager::init();

            AuthController::createSession($username, $db->lastInsertId());
        }
    }
}