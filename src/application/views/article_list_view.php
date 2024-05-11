<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/src/public/css/ArticleList.css">
</head>
<body>
<?php foreach ($data['articles'] as $article): ?>
    <li><a href="/article/view/<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></li>
<?php endforeach; ?>
</body>
</html>