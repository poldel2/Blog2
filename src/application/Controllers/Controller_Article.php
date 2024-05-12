<?php

namespace Laravel\Blog\application\Controllers;
use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Article;
use Laravel\Blog\application\models\Repositories\ArticleRepository;
use Laravel\Blog\application\models\SessionManager;
use Laravel\Blog\Framework\core\Controller;

class Controller_Article extends Controller
{
    private ArticleRepository $articleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->articleRepository = new ArticleRepository(DB::getConnection());
    }

    function index(): void
    {
        $page = 1;
        $limit = 10;
        $articles = $this->articleRepository->getArticles($page, $limit);

        $data = [
            'articles' => $articles
        ];

        $this->view->generate('article_list_view.php', 'template_view.php', $data);
    }

    function viewArticle($id): void
    {

        $article = $this->articleRepository->getByKey($id);
        $data = [
            'article' => $article
        ];
        $this->view->generate('view_article_view.php', 'template_view.php', $data);
    }

    function editArticle($id): void
    {
        $article = $this->articleRepository->getByKey($id);
        SessionManager::init();
        if (SessionManager::get('user_id') == $article->getUserId()) {
            $data = [
                'article' => $article
            ];
            $this->view->generate('edit_article_view.php', 'template_view.php', $data);
        } else {
            echo "Unauthorized access";
        }
    }

    function updateArticle($id): void
    {
        SessionManager::init();

        $article = new Article($_POST['title'], $_POST['content'], SessionManager::get('user_id'));

        SessionManager::init();
        if (SessionManager::get('user_id') == $article->getUserId()) {
            $article->setId($id);
            $this->articleRepository->update($article);

            header('Location: /article/view/'.$id);
        } else {
            echo "Unauthorized access";
        }
    }


}