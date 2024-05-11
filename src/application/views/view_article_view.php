<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/public/css/Article.css">
    <?php $article = $data['article']; echo $article->getId();?>
    <title><?= htmlspecialchars($article->getTitle()) ?> </title>

</head>
<body>
<h1><?= htmlspecialchars($article->getTitle()) ?></h1>
<p><?= nl2br(htmlspecialchars($article->getContent())) ?></p>

<h2>Комментарии</h2>
<div id="comments">
</div>

<div id="comments">
    <!-- Здесь будут динамически загружаться комментарии -->
</div>

<button id="loadMoreComments" onclick="loadComments()">Показать еще</button>

<script>
    let current_page = 1;
    let article_id = <?= $article->getId(); ?>;

    function loadComments() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `/fetchComments/${article_id}/${current_page}`);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const newComments = JSON.parse(xhr.responseText);
                const commentsContainer = document.getElementById('comments');
                newComments.forEach(comment => {
                    const p = document.createElement('p');
                    p.textContent = `${comment.name}: ${comment.comment}`; // Отображение как "имя отправителя: комментарий"
                    commentsContainer.appendChild(p);
                });
                current_page++;
            } else {
                console.error('Failed to fetch comments:', xhr.responseText);
            }
        };
        xhr.send();
    }



    // Для начальной загрузки
    loadComments();
</script>

<?php
    $user = \Laravel\Blog\application\Controllers\AuthController::getUser();

    if ($user)
        $userId = $user->getId();
?>

<h3>Добавить комментарий</h3>
<form action="/addComment/process" method="post">
    <input type="hidden" name="article_id" value="<?= $article->getId(); ?>">
    <input type="hidden" name="user_id" value="<?= $userId; // Убедитесь, что user_id сохранён в сессии ?>">
    <label>
        <textarea name="comment_content" required></textarea>
    </label><br>
    <button type="submit">Отправить</button>
</form>

</body>
</html>