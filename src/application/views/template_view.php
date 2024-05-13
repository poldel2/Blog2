<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="/src/public/css/styles.css">
</head>
<body>

<nav class="nav">
    <div class="nav__title">Блог</div>
    <ul class="nav__list">
        <li class="nav__item"><a href="/addArticle">Добавить статью</a></li>
        <li class="nav__item"><a href="/main">Просмотреть статьи</a></li>
        <li class="nav__item"><a href="/blog">эээ</a></li>
        <?php

        use Laravel\Blog\application\Controllers\AuthController;
        use Laravel\Blog\Framework\SessionManager;

        SessionManager::init();

        if (AuthController::isLoggedIn()) {
            $username = SessionManager::get('login');
            //$username = AuthController::getUser()->getUsername();
            $user = AuthController::getUser();
            echo "<a href='/login'>$username </a>";
        } else {
            echo "<a href='/login'>Гость</a>";
            $user = null;
        }
        ?>
    </ul>
</nav>
    <?php include 'src/application/views/'.$content_view; ?>
</body>
</html>