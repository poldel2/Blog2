<?php

try {
    $sql = "
    CREATE TABLE IF NOT EXISTS likes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        article_id INT,
        user_id INT,
        UNIQUE KEY unique_like (article_id, user_id),
        FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";
    $db->exec($sql);
    echo "Таблица 'likes' создана успешно.";
} catch (PDOException $e) {
    die("Ошибка миграции: " . $e->getMessage());
}