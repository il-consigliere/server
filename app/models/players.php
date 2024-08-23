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
