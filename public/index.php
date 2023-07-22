<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    header("Access-Control-Allow-Origin: *");

    if (isset($_SERVER['QUERY_STRING']) && str_contains($_SERVER['QUERY_STRING'], 'searchCep')) {
        
        $param = explode('=', $_SERVER['QUERY_STRING']);

        /** @var \OpinionBox\Controllers\ClientController $app */
        echo $app->searchCep($param[1]);

        return;
    }
}
