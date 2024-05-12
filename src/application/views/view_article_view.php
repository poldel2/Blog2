<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/public/css/Article.css">
    <?php $article = $data['article'];?>
    <title><?= htmlspecialchars($article->getTitle()) ?> </title>

</head>
<body>
<h1><?= htmlspecialchars($article->getTitle()) ?></h1>
<p><?= nl2br(htmlspecialchars($article->getContent())) ?></p>

<a href="editArticle/<?= $article->getId() ?>">Edit</a>


<div id="likeSection">
    <button id="likeButton">Лайк!</button>
    <span id="likeCount">Лайков: 213</span>
</div>

<h2>Комментарии</h2>
<div id="comments">
</div>

<div id="comments">

</div>

<button id="loadMoreComments" onclick="loadComments()">Показать еще</button>

<script>
    let current_page = 1;
    let article_id = <?= $article->getId(); ?>;

    let user_id = <?= $user ? $user->getId() : 0 ?>;

    function loadComments() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `/fetchComments/${article_id}/${current_page}`);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const newComments = JSON.parse(xhr.responseText);
                const commentsContainer = document.getElementById('comments');
                newComments.forEach(comment => {
                    const p = document.createElement('p');
                    p.textContent = `${comment.name}: ${comment.comment}`;
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

    function fetchLikes() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `/likesCount/${article_id}`);
        xhr.onload = () => {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const data = JSON.parse(xhr.responseText);
                console.log(data);
                document.getElementById('likeCount').textContent = `Лайков: ${data.likesCount}`;
            } else {
                console.error('Failed to load likes:', xhr.responseText);
            }
        };
        xhr.send();
    }

    function toggleLike() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', `/toggleLike/${article_id}/${user_id}`);
        xhr.onload = () => {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const data = JSON.parse(xhr.responseText);
                if (data.success) {
                    fetchLikes();
                }
            } else {
                console.error('Failed to toggle like:', xhr.responseText);
            }
        };
        xhr.send();
    }

    document.getElementById('likeButton').addEventListener('click', toggleLike);

    // Начальная загрузка лайков
    fetchLikes();
</script>

<?php
    $user = \Laravel\Blog\application\Controllers\AuthController::getUser();

    if ($user)
        $userId = $user->getId();
?>

<h3>Добавить комментарий</h3>
<form action="/addComment/process" method="post">
    <input type="hidden" name="article_id" value="<?= $article->getId(); ?>">
    <input type="hidden" name="user_id" value="<?= $user ? $user->getId() : 0 ?>">
    <label>
        <textarea name="comment_content" required></textarea>
    </label><br>
    <button type="submit">Отправить</button>
</form>

</body>
</html>