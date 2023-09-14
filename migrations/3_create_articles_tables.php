<?php
function up()
{
    global $pdo;

    $query = "
        CREATE TABLE IF NOT EXISTS articles (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            content LONGTEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			image_path VARCHAR(255) DEFAULT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )
    ";

    $pdo->query($query);
}

function down()
{
    global $pdo;

    $query = "DROP TABLE IF EXISTS articles";
    $pdo->query($query);
}
