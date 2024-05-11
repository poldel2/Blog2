<?php


try {
    $sql = "
    CREATE TABLE IF NOT EXISTS articles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        content TEXT,
        published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";
    $db->exec($sql);
    echo "Таблица 'articles' создана успешно.";
} catch (PDOException $e) {
    die("Ошибка миграции: " . $e->getMessage());
}
