<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function add_player_action(): void
{
    $master_id = $_SESSION['user_id'];
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$name || !$comment) {
        http_response_code(400);
        exit;
    }

    load_model('masters');
    load_model('players');

    $organization_id = get_organization_id_by_master_id($master_id);
    $player_id = create_player($organization_id, $master_id, $name, $comment);

    response_with_json(['player_id' => $player_id]);
}
