<?php

declare(strict_types=1);

namespace OpinionBox\Services\Address;

use OpinionBox\Repositories\Address\AddressRepository;
use OpinionBox\Services\Service;

class AddressService extends Service
{
    /**
     * @param AddressRepository $addressRepository
     */
    public function __construct(private readonly AddressRepository $addressRepository)
    {
    }

    /**
     * @param array $params
     * @return array
     */
    private function getParams(array $params): array
    {
        return [
            'number'       => $params['numero'],
            'address'      => $params['rua'],
            'neighborhood' => $params['bairro'],
            'city'         => $params['cidade'],
            'state'        => $params['estado'],
            'client_id'    => $params['client_id']
        ];
    }

    /**
     * @param array $params
     * @return int
     */
    public function create(array $params): int
    {
        return $this->addressRepository->create($this->getParams($params));
    }

    /**
     * @param array $params
     * @param int $id
     * @return void
     */
    public function update(array $params, int $id): void
    {
        $params = $this->getParams($params);

        unset($params['client_id']);

        $this->addressRepository->updte($params, "id = {$id}");
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->addressRepository->destroy($id);
    }

    /**
     * @return array
     */
    public function getZipCodesByAddress(): array
    {
        $addressData = $this->addressRepository->index('*');

        $addressWithZipCodes = [];

        foreach ($addressData as $key => $address) {
            $query = "
                SELECT count(id) AS quantity
                FROM zipcodes
                WHERE address_id = {$address['id']};
            ";

            $result = $this->addressRepository->rawQuery($query)[0];

            $data = [
                'neighborhood' => $address['address'],
                'zipCodesQuantity' => $result['quantity']
            ];

            $addressWithZipCodes[] = $data;
        }

        return $addressWithZipCodes;
    }

    /**
     * @return array
     */
    public function getAddressWithMoreZipCodes(): array
    {
        $addressData = $this->addressRepository->index('*');

        $addresWithMoreZipCodes = [];

        foreach ($addressData as $key => $address) {
            $query = "
                SELECT count(zipcodes.id) AS quantity, address.neighborhood
                FROM zipcodes
                INNER JOIN address
                ON address.id = zipcodes.address_id
                WHERE address_id = {$address['id']};
            ";

            $result = $this->addressRepository->rawQuery($query)[0];

            if ($result['quantity'] > 1) {
                $data = [
                    'neighborhood' => $address['address']
                ];

                $addresWithMoreZipCodes[] = $data;
            }
        }

        return $addresWithMoreZipCodes;
    }
}
