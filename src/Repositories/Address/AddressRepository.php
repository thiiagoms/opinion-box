<?php

declare(strict_types=1);

namespace OpinionBox\Repositories\Address;

use OpinionBox\Repositories\Repository;

class AddressRepository extends Repository
{
    /**
     * @var string
     */
    protected string $table = 'address';
}
