<?php


require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'core/Controller.php';
require_once 'core/Router.php';
require_once 'Controllers/Controller_Article.php';
require_once 'Controllers/controller_register.php';

$router = new router();
$router->route(); // Вызов метода route() для обработки запроса

//without parameter
//$route->add("GET", "/", [new Controller_Article(), 'action_index']);
//$route->add("GET","/main", [new Controller_Article(), 'action_index']);
//$route->add("POST","/register", [new controller_register(), 'register']);
//$route->add("GET","/register", [new controller_register(), 'action_index']);

//$route->add("/user/{id}","user.php");

//in user.php access id like this :
//$params['id'];

//At the last of index.php file call notFound() method of Route for 404 error.
