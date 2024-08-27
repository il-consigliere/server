<?php

require 'lib.php';

setup_session();

$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$method = substr(trim($path, '/'), 4); // Отрезаем префикс "/api".
$routes = require 'routes.php';

if (array_key_exists($method, $routes)) {
    // Единственный метод,
    // к которому можно обратиться без авторизации — это enter.
    if ($method !== 'enter' && !isset($_SESSION['user_id'])) {
        http_response_code(401);
        exit;
    }

    require "controllers/$routes[$method].php";

    // Заменяем дефисы подчёркиваниями в имени метода,
    // чтобы получить настоящее имя функции.
    call_user_func(str_replace('-', '_', $method) . '_action');
} else {
    http_response_code(404);
}
