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
<?php $article = $data['article'] ?>
<form action="process/<?= $article->getId(); ?>" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?= $article->getTitle(); ?>">
    <label for="content">Content:</label>
    <textarea id="content" name="content"><?= $article->getContent(); ?></textarea>
    <button type="submit">Save Changes</button>
</form>

</body>
</html>