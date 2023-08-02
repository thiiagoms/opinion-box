<?php

require_once __DIR__ . '/resources/views/header.php';
require_once __DIR__ . '/bootstrap.php';

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $app->destroy($id);

    header('Location: list.php');
}
