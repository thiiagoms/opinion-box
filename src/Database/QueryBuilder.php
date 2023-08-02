<?php

namespace OpinionBox\Database;

use OpinionBox\Database\Connection\Connection;
use PDOStatement;

/**
 * Execute database queries
 *
 * @package OpinionBox\Infra\Database
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
class QueryBuilder extends Connection
{
    public function __construct()
    {
        $this->open();
    }

    /**
     * @param string $query
     * @param array $params
     * @return bool|PDOStatement
     */
    private function execute(string $query, array $params = []): bool|PDOStatement
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);

            return $stmt;
        } catch (\PDOException $e) {
            echo "Falha ao executar a query: {$e->getMessage()}";
            exit;
        }
    }

    /**
     * @param array|null $where
     * @return array
     */
    private function bindWhere(?array $where): array
    {
        $whereClause = '';
        $bindValues = [];

        if (!is_null($where)) {
            $conditions = [];

            foreach ($where as $column => $value) {
                $conditions[] = "{$column} = ?";
                $bindValues[] = $value;
            }

            $whereClause = "WHERE " . implode(' AND ', $conditions);
        }

        return [$whereClause, $bindValues];
    }

    /**
     * @param string $query
     * @return array|bool
     */
    public function rawQuery(string $query): array|bool
    {
        return $this->execute($query)->fetchAll();
    }

    /**
     * @param string $fields
     * @param array $where
     * @return array|bool
     */
    public function select(string $table, string $fields, ?array $where = null): array|bool
    {
        list($whereClause, $bindValues) = $this->bindWhere($where);

        $query = "SELECT {$fields} FROM {$table} {$whereClause}";

        return $this->execute($query, $bindValues)->fetchAll();
    }

    /***
     * @param string $table
     * @param array $params
     * @return int
     */
    public function insert(string $table, array $params): int
    {
        $fields = array_keys($params);
        $values = array_pad([], count($fields), '?');

        $newFields = implode(',', $fields);
        $newValues = implode(',', $values);

        $query = "INSERT INTO {$table} ({$newFields}) VALUES ({$newValues})";

        $this->execute($query, array_values($params));

        return $this->conn->lastInsertId();
    }

    /**
     * @param string $table
     * @param array $params
     * @param string $where
     * @return void
     */
    public function update(string $table, array $params, string $where): void
    {
        $fields = array_keys($params);

        $query = 'UPDATE ' . $table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        $this->execute($query, array_values($params));
    }

    /**
     * @param string $table
     * @param int $id
     * @return void
     */
    public function delete(string $table, int $id): void
    {
        $query = "DELETE FROM {$table} WHERE id = {$id}";

        $this->execute($query);
    }
}
