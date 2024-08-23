<?php

session_start();

$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$path = trim($path, '/');
$routes = require 'routes.php';

if (array_key_exists($path, $routes)) {
    // Единственный путь, куда можно попасть без авторизации — это enter.
    if ($path !== 'enter' && !isset($_SESSION['user_id'])) {
        http_response_code(401);
        exit;
    }

    require 'lib.php';
    require "controllers/$routes[$path].php";

    call_user_func($path . '_action');
} else {
    http_response_code(404);
}
