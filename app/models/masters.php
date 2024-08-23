<?php

function get_user_by_name(string $name): array
{
    $pdo = pdo();
    $query = 'select id, password from masters where name = :name';
    $statement = $pdo->prepare($query);

    $statement->execute(['name' => $name]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}
