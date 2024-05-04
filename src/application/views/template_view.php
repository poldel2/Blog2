<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="src/public/css/styles.css">
</head>
<body>

<nav class="nav">
    <div class="nav__title">Site Title</div>
    <ul class="nav__list">
        <li class="nav__item">Services</li>
        <li class="nav__item">About Us</li>
        <li class="nav__item">Blog</li>
        <?php

        use Laravel\Blog\application\Controllers\controller_login;
        use Laravel\Blog\application\models\SessionManager;

        SessionManager::init();

        if (Controller_login::isLoggedIn()) {
            $username = SessionManager::get('login');
            echo "Привет, $username!";
        } else {
            echo "Гость";
        }
        ?>
    </ul>
</nav>
    <?php include 'src/application/views/'.$content_view; ?>
</body>
</html>