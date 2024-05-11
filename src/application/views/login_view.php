<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="src/public/css/Login.css">
</head>
<body>
<div class="login-container">
    <h2>Вход</h2>
    <form method="POST" action="/login/process">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
        <a href="/register">Еще нет аккаунта?</a>
    </form>
</div>
</body>
</html>
