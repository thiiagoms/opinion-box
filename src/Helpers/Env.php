<?php

declare(strict_types=1);

namespace OpinionBox\Helpers;

use Dotenv\Dotenv;


class Env
{
    /**
     * @var string
     */
    private const ENVPATH = __DIR__ . '/../../';

    /**
     * @return bool
     */
    private static function check(): bool
    {
        return file_exists(self::ENVPATH . '.env');
    }

    /**
     * @return void
     */
    public static function load(): void
    {
        if (!self::check()) {
            echo "Arquivo .env não existe";
            exit;
        }

        (Dotenv::createImmutable(self::ENVPATH))->load();
    }
}
