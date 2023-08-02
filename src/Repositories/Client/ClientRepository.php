<?php

namespace OpinionBox\Repositories\Client;

use OpinionBox\Repositories\Repository;

class ClientRepository extends Repository
{
    /**
     * @var string
     */
    protected string $table = 'clients';

    /**
     * @param string $fields
     * @param string|null $where
     * @return array|bool
     */
    public function getClientsWithCep(string $fields, ?string $where = null)
    {
        $sql = "
            SELECT {$fields}
            FROM clients
            INNER JOIN address ON clients.id = address.client_id
            INNER JOIN zipcodes ON address.id = zipcodes.address_id
        ";

        if (!is_null($where)) {
            $sql .= "WHERE {$where}";
        }

        return $this->rawQuery($sql);
    }
}
