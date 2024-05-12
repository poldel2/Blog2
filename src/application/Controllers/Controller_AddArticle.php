<?php

namespace Laravel\Blog\application\Controllers;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Article;
use Laravel\Blog\application\models\Repositories\ArticleRepository;
use Laravel\Blog\application\models\SessionManager;
use Laravel\Blog\Framework\core\Controller;

class Controller_AddArticle extends Controller
{
    function index(): void
    {
        $this->view->generate('add_article_view.php', 'template_view.php');
    }

    function addArticle(): void
    {
        SessionManager::init();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!AuthController::isLoggedIn()) {
                header("Location: /../login");
                exit;
            }

            $title = $_POST['title'];
            $content = $_POST['content'];
            $user_id = SessionManager::get('user_id'); // Предполагаем, что user_id хранится в сессии

            $db = DB::getConnection();

            $articleRepository = new ArticleRepository($db);

            $article = new Article($title, $content, $user_id);

            $articleRepository->save($article);

            header("Location: /../main");
        }
    }
}