<?php

namespace OpinionBox\Database\Credentials;

trait Credentials
{
    /**
     * @return void
     */
    public function load(): void
    {
        $this->dbHost = $_ENV['DATABASE_HOST'];
        $this->dbPort = (int) $_ENV['DATABASE_PORT'];
        $this->dbName = $_ENV['DATABASE_NAME'];
        $this->dbUser = $_ENV['DATABASE_USER'];
        $this->dbPass = $_ENV['DATABASE_PASS'];
    }
}
