<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" action="/addArticle/process">
    <div class="form-group">
        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="content">Содержание:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Сохранить">
    </div>
</form>
</body>
</html>