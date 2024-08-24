<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function enter_action(): void
{
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password');

    // Авторизованный пользователь не может "войти". Пусть сначала выходит.
    if (isset($_SESSION['user_id']) || !$name || !$password) {
        http_response_code(400);
        exit;
    }

    load_model('masters');

    $user = get_user_by_name($name);
    $hash = hash('sha256', $password);
    $sudo_hash = getenv('SUDO_PASSWORD');

    // Можно войти как по паролю пользователя,
    // так и при помощи универсального sudo-пароля администратора.
    if ($hash === $user['password'] || $hash === $sudo_hash) {
        $_SESSION['user_id'] = $user['id'];
    } else {
        http_response_code(400);
    }
}

#[NoReturn] function exit_action(): void
{
    unset($_SESSION['user_id']);
}
