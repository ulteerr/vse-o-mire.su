<?php
function up()
{
	global $pdo;

	$query = "
        CREATE TABLE IF NOT EXISTS replies (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            comment_id INT NOT NULL,
            content LONGTEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE CASCADE
        )
    ";

	$pdo->query($query);
}

function down()
{
	global $pdo;

	$query = "DROP TABLE IF EXISTS replies";
	$pdo->query($query);
}
