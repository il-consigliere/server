<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function save_game_action(): void
{
    $master_id = $_SESSION['user_id'];
    $body = file_get_contents('php://input');
    $data = json_decode($body, true);

    if (
        !isset($data['winningTeamId']) ||
        !isset($data['players']) ||
        !is_array($data['players'])
    ) {
        http_response_code(400);
        exit;
    }

    load_model('games');
    load_model('masters');

    $players = $data['players'];
    $winning_team_id = $data['winningTeamId'];
    $organization_id = get_organization_id_by_master_id($_SESSION['user_id']);

    try {
        insert_game_data(
            $organization_id,
            $master_id,
            $winning_team_id,
            $players,
        );
    } catch (Exception) {
        http_response_code(400);
    }
}
