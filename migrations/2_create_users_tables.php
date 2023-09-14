<?php

function up()
{
    global $pdo;

    $query = "
    CREATE TABLE users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role_id INT NOT NULL,
        image_path VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (role_id) REFERENCES roles(id)
    )
";

    $pdo->query($query);
}

function down()
{
    global $pdo;

    $query = "DROP TABLE IF EXISTS users";
    $pdo->query($query);
}
