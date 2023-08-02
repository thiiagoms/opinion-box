<?php

declare(strict_types=1);

namespace OpinionBox\Database\Connection;

use OpinionBox\Database\Credentials\Credentials;
use PDO;
use PDOException;

/**
 * Manage database connection
 *
 * @package OpinionBox\Infra\Database\Connection
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
class Connection
{
    use Credentials;

    /**
     * @var string
     */
    protected string $dbHost;

    /**
     * @var int
     */
    protected int $dbPort;

    /**
     * @var string
     */
    protected string $dbName;

    /**
     * @var string
     */
    protected string $dbUser;

    /**
     * @var string
     */
    protected string $dbPass;

    /**
     * @var PDO
     */
    protected PDO $conn;

    /**
     * @return PDO
     */
    protected function open(): PDO
    {
        $this->load();

        try {
            $this->conn = new PDO(
                "mysql:host={$this->dbHost};port={$this->dbPort};dbname={$this->dbName}",
                $this->dbUser,
                $this->dbPass
            );

            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (PDOException $e) {
            echo "Datbase connection error: {$e->getMessage()}";
            exit;
        }
    }
}
