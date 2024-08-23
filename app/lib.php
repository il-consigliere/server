<?php

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

function load_model($name): void
{
    require $_SERVER['DOCUMENT_ROOT'] . "/models/$name.php";
}
