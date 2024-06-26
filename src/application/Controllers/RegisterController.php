<?php


namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\models\Repositories\UserRepository;
use Laravel\Blog\application\models\UserDTO;
use Laravel\Blog\Framework\core\Controller;
use Laravel\Blog\Framework\DB;
use Laravel\Blog\Framework\SessionManager;
use Laravel\Blog\Framework\Validators\FormValidator;

class RegisterController extends Controller
{
    function index(): void
    {
        $this->view->generate('register_view.php');
    }

    function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $validator = new FormValidator();

            if (!$validator->validateField('name', $_POST['name'])) {
                header ("Location: /register");
                return;
            }

            if (!$validator->validateField('email', $_POST['email'])) {
                header ("Location: /register");
                return;
            }

            if (!$validator->validateField('password', $_POST['password'])) {
                header ("Location: /register");
                return;
            }

            if (!$validator->validateField('password_confirmation', $_POST['password_confirmation'])) {
                header ("Location: /register");
                return;
            }

            $username = $_POST['name'];
            $email = $_POST['email'];
            $password_1 = $_POST['password'];
            $password_2 = $_POST['password_confirmation'];

            if ($password_1 !== $password_2) {
                //По хорошему выводить еще и сообщение
                header ("Location: /register");
                return;
            }

            $db = DB::getConnection();

            $userRepository = new UserRepository($db);

            $user = new UserDTO($username, $email, $password_1);

            $userRepository->save($user);

            SessionManager::init();

            AuthController::createSession($username, $db->lastInsertId());

            header("Location: /main");
        }
    }
}