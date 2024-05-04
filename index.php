<?php

use Laravel\Blog\application\core\Router;

require 'vendor/autoload.php';

echo "13123";

$router = new Router();

$router->route();

if ($router)
    echo "123";
else
    echo '1233';