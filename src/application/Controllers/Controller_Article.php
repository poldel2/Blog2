<?php

namespace Laravel\Blog\application\Controllers;
use Laravel\Blog\application\core\Controller;
use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\Repositories\ArticleRepository;

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
}