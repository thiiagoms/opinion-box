<?php

declare(strict_types=1);

namespace OpinionBox\Repositories;

use OpinionBox\Database\QueryBuilder;

abstract class Repository extends QueryBuilder
{
    /**
     * @var string
     */
    protected string $table = '';

    /**
     * @param string $fields
     * @param array|null $where
     * @return array
     */
    public function index(string $fields, ?array $where = null): array
    {
        return $this->select($this->table, $fields, $where);
    }

    /**
     * @param array $params
     * @return int
     */
    public function create(array $params): int
    {
        return $this->insert($this->table, $params);
    }

    /**
     * @param array $params
     * @param string $where
     * @return void
     */
    public function updte(array $params, string $where)
    {
        $this->update($this->table, $params, $where);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->delete($this->table, $id);
    }
}
