<?php

declare(strict_types=1);

namespace OpinionBox\Repositories\ZipCode;

use OpinionBox\Repositories\Repository;

class ZipCodeRepository extends Repository
{
    /**
     * @var string
     */
    protected string $table = 'zipcodes';

    /**
     * @param string $zipCode
     * @return array
     */
    public function searchZipCode(string $zipCode): array
    {
        return json_decode(
            file_get_contents("https://viacep.com.br/ws/{$zipCode}/json/"),
            true
        );
    }
}
