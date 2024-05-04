<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="src/public/css/Login.css">
</head>
<body>
<div class="login-container">
    <h2>Регистрация</h2>
    <form method="POST" action="/register/process">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Подтвердите пароль:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</div>
</body>
</html>