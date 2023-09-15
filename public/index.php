<?php

use app\core\Router;

require '../app/lib/require.php';



session_start();

$router = new Router;
$router->run();
