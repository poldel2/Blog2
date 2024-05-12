<?php

namespace Laravel\Blog\Framework\core;

use Laravel\Blog\application\Controllers\Controller_AddArticle;
use Laravel\Blog\application\Controllers\Controller_Article;
use Laravel\Blog\application\Controllers\Controller_Comment;
use Laravel\Blog\application\Controllers\Controller_Login;
use Laravel\Blog\application\Controllers\Controller_Register;
use Laravel\Blog\application\Controllers\LikeController;

class Router {
    protected $routes = [
        'register' => ['controller' => Controller_Register::class, 'method' => 'index'],
        'register/process' => ['controller' => Controller_Register::class, 'method' => 'register'],
        'login' => ['controller' => Controller_Login::class, 'method' => 'index'],
        'login/process' => ['controller' => Controller_Login::class, 'method' => 'login'],
        'main' => ['controller' => Controller_Article::class, 'method' => 'index'],
        'addArticle' => ['controller' => Controller_AddArticle::class, 'method' => 'index'],
        'addArticle/process' => ['controller' => Controller_AddArticle::class, 'method' => 'addArticle'],
        'article/view/{article_id}' => ['controller' => Controller_Article::class, 'method' => 'viewArticle'],
        'addComment/process' => ['controller' => Controller_Comment::class, 'method' => 'addComment'],
        'fetchComments/{article_id}/{page}' => ['controller' => Controller_Comment::class, 'method' => 'fetchComments'],
        'likesCount/{article_id}' => ['controller' => LikeController::class, 'method' => 'countLikes'],
        'toggleLike/{article_id}/{user_id}' => ['controller' => LikeController::class, 'method' => 'toggleLike'],
        'article/view/editArticle/{article_id}' => ['controller' => Controller_Article::class, 'method' => 'editArticle'],
        'article/view/editArticle/process/{article_id}' => ['controller' => Controller_Article::class, 'method' => 'updateArticle']
    ];

    function route(): void {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uriParts = explode('/', $uri);

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

}
