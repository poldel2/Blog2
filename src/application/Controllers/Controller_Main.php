<?php

namespace Laravel\Blog\application\Controllers;
use Laravel\Blog\application\core\Controller;

class Controller_Main extends Controller
{
    function index(): void
    {
        $this->view->generate('article_list_view.php', 'template_view.php');
    }
}