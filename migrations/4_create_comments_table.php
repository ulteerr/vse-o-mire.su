<?php
function up()
{
    global $pdo;

    $query = "
        CREATE TABLE IF NOT EXISTS comments (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            article_id INT NOT NULL,
            content LONGTEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
        )
    ";

    $pdo->query($query);
}

function down()
{
    global $pdo;

    $query = "DROP TABLE IF EXISTS comments";
    $pdo->query($query);
}
