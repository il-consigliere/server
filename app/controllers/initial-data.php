<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function data_action(): void
{
    load_model('roles');
    load_model('masters');
    load_model('players');

    $organization_id = get_organization_id_by_master_id($_SESSION['user_id']);

    response_with_json([
        ...get_teams_and_roles(),
        'players' => get_players($organization_id),
    ]);
}
