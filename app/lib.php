<?php

use JetBrains\PhpStorm\NoReturn;

function setup_session(): void
{
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Strict',
        'lifetime' => 60 * 60 * 24,
    ]);

    session_start();
}

function pdo(): PDO
{
    static $pdo = null;

    if (!$pdo) {
        $host = 'mysql:host=' . getenv('MYSQL_HOST') . ';';
        $init = $host . 'dbname=' . getenv('MYSQL_DATABASE');
        $pdo = new PDO($init, getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    }

    return $pdo;
}

function load_model(string $name): void
{
    require $_SERVER['DOCUMENT_ROOT'] . "/models/$name.php";
}

#[NoReturn] function response_with_json($data): void
{
    header('Content-type: application/json');
    exit(json_encode($data, JSON_UNESCAPED_UNICODE));
}
