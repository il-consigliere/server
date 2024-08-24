<?php

/**
 * @throws Exception
 */
function insert_game_data(
    int $organization_id,
    int $master_id,
    int $winning_team_id,
    array $players,
): void {
    $pdo = pdo();

    $pdo->beginTransaction();

    try {
        $gameQuery = '
            insert into games (organization_id, master_id, winning_team_id)
            values (:organization_id, :master_id, :winning_team_id)
        ';

        $gameCreation = $pdo->prepare($gameQuery);

        $gameCreation->execute([
            ':master_id' => $master_id,
            ':organization_id' => $organization_id,
            ':winning_team_id' => $winning_team_id,
        ]);

        $gameId = $pdo->lastInsertId();

        foreach ($players as $player) {
            if (!isset($player['id']) || !isset($player['roleId'])) {
                throw new Exception();
            }

            $query = '
                insert into players_in_games (game_id, role_id, player_id)
                values (:game_id, :role_id, :player_id)
            ';

            $statement = $pdo->prepare($query);

            $statement->execute([
                ':game_id' => $gameId,
                ':player_id' => $player['id'],
                ':role_id' => $player['roleId'],
            ]);
        }

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollback();
        throw($e);
    }
}
