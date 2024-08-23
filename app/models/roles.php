<?php

function get_teams_and_roles(): array
{
    $pdo = pdo();
    $teams = $pdo->query('select * from teams')->fetchAll(PDO::FETCH_ASSOC);
    $roles = $pdo->query('select * from roles')->fetchAll(PDO::FETCH_ASSOC);

    return [
        'teams' => $teams,
        'roles' => $roles,
    ];
}
