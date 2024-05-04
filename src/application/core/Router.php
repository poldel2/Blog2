<?php

namespace Laravel\Blog\application\core;
use Laravel\Blog\application\Controllers\Controller_Main;
use Laravel\Blog\application\Controllers\controller_register;

class Router
{
    public static function route(): void
    {
        echo 'qq1233';
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/'); // Убираем слэши в начале и конце

        if ($uri === 'register') {
            // Обработка страницы регистрации
            $controller = new controller_register();
            $controller->index();
            echo 'reg';
        } elseif ($uri === 'register/process') {
            // Обработка POST запроса
            $controller = new controller_register();
            $controller->register();
            echo 'reg2';
        } elseif ($uri === 'main') {
            $controller = new Controller_Main();
            $controller->index();
        }
    }
}