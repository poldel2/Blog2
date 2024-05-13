<?php

namespace Laravel\Blog\Framework\core;

use Laravel\Blog\application\Controllers\AddArticleController;
use Laravel\Blog\application\Controllers\ArticleController;
use Laravel\Blog\application\Controllers\CommentController;
use Laravel\Blog\application\Controllers\LoginController;
use Laravel\Blog\application\Controllers\RegisterController;
use Laravel\Blog\application\Controllers\LikeController;

class Router {
    protected $routes = [
        'register' => ['controller' => RegisterController::class, 'method' => 'index'],
        'register/process' => ['controller' => RegisterController::class, 'method' => 'register'],
        'login' => ['controller' => LoginController::class, 'method' => 'index'],
        'login/process' => ['controller' => LoginController::class, 'method' => 'login'],
        'main' => ['controller' => ArticleController::class, 'method' => 'index'],
        'addArticle' => ['controller' => AddArticleController::class, 'method' => 'index'],
        'addArticle/process' => ['controller' => AddArticleController::class, 'method' => 'addArticle'],
        'article/view/{article_id}' => ['controller' => ArticleController::class, 'method' => 'viewArticle'],
        'addComment/process' => ['controller' => CommentController::class, 'method' => 'addComment'],
        'fetchComments/{article_id}/{page}' => ['controller' => CommentController::class, 'method' => 'fetchComments'],
        'likesCount/{article_id}' => ['controller' => LikeController::class, 'method' => 'countLikes'],
        'toggleLike/{article_id}/{user_id}' => ['controller' => LikeController::class, 'method' => 'toggleLike'],
        'article/view/editArticle/{article_id}' => ['controller' => ArticleController::class, 'method' => 'editArticle'],
        'article/view/editArticle/process/{article_id}' => ['controller' => ArticleController::class, 'method' => 'updateArticle']
    ];

    function route(): void {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uriParts = explode('/', $uri);

        if (empty($uri)) {
            $this->redirect('/main');
            return;
        }

        foreach ($this->routes as $path => $controllerInfo) {
            $pattern = preg_replace('#\{[\w]+\}#', '([^/]+)', $path);
            if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                array_shift($matches);
                $controllerName = $controllerInfo['controller'];
                $method = $controllerInfo['method'];

                $controller = new $controllerName();
                if (!empty($matches)) {
                    $controller->$method(...$matches);
                } else {
                    $controller->$method();
                }

                return;
            }
        }
        echo "404 Not Found";
    }

    protected function redirect(string $url): void {
        header("Location: $url");
        exit;
    }

}
