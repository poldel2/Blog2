<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\SessionManager;
use Laravel\Blog\Framework\core\Controller;
use Laravel\Blog\Framework\Validators\FormValidator;

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
        $validator = new FormValidator();

        if (!$validator->validateField('name', $_POST['name'])) {
            header ("Location: /register");
            return;
        }

        if (!$validator->validateField('password', $_POST['password'])) {
            header ("Location: /register");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];

            if (empty($name) || empty($password)) {
                header("Location: /login");
                return;
            }

            $db = DB::getConnection();

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
                }
            } else {
                header("Location: /login");
            }
        }
    }

}