<?php
function up()
{
    global $pdo;

    $query = "
        CREATE TABLE roles (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL
        )
    ";

    $pdo->query($query);
}

function down()
{
    global $pdo;

    $query = "DROP TABLE IF EXISTS roles";
    $pdo->query($query);
}
