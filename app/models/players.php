<?php

function get_players(int $organization_id): array
{
    $pdo = pdo();

    $query = '
        select
            id,
            name,
            comment
        from players
        where organization_id = :organization_id
    ';

    $statement = $pdo->prepare($query);

    $statement->execute(['organization_id' => $organization_id]);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function create_player(
    int $organization_id,
    int $master_id,
    string $name,
    string $comment,
): int {
    $pdo = pdo();

    $query = '
        insert into players (organization_id, master_id, name, comment)
        values (:organization_id, :master_id, :name, :comment)
    ';

    $statement = $pdo->prepare($query);

    $statement->execute([
        'name' => $name,
        'comment' => $comment,
        'master_id' => $master_id,
        'organization_id' => $organization_id,
    ]);

    return $pdo->lastInsertId();
}
