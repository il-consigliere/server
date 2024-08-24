<?php

function get_user_by_name(string $name): array
{
    $pdo = pdo();
    $query = 'select id, password from masters where name = :name';
    $statement = $pdo->prepare($query);

    $statement->execute(['name' => $name]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function get_organization_id_by_master_id(int $master_id): int
{
    $pdo = pdo();
    $query = 'select organization_id from masters where id = :master_id';
    $statement = $pdo->prepare($query);

    $statement->execute(['master_id' => $master_id]);

    return $statement->fetch(PDO::FETCH_ASSOC)['organization_id'];
}

function update_password(string $master_id, string $password): void
{
    $pdo = pdo();
    $query = 'update masters set password = :password where id = :master_id';
    $statement = $pdo->prepare($query);

    $statement->execute(['password' => $password, 'master_id' => $master_id]);
}
