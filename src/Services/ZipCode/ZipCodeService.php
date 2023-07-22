<?php

declare(strict_types=1);

namespace OpinionBox\Services\ZipCode;

use OpinionBox\Repositories\ZipCode\ZipCodeRepository;
use OpinionBox\Services\Service;

class ZipCodeService extends Service
{
    /**
     * @param ZipCodeRepository $zipCodeRepository
     */
    public function __construct(private readonly ZipCodeRepository $zipCodeRepository)
    {
    }

    /**
     * @param array $params
     * @return array
     */
    private function getParams(array $params): array
    {
        return ['zipcode' => $params['cep'], 'address_id' => $params['address_id']];
    }


    /**
     * @param string $zipCode
     * @return array
     */
    public function searchZipCode(string $zipCode): array
    {
        $result = $this->zipCodeRepository->searchZipCode($zipCode);

        return !empty($result)
            ? ['status' => 'success', 'content' => $result]
            : ['status' => 'error',   'content' => $result];
    }

    /**
     * @param array $params
     * @return int
     */
    public function create(array $params): int
    {
        return $this->zipCodeRepository->create($this->getParams($params));
    }

    /**
     * @param $params
     * @param $id
     * @return void
     */
    public function update($params, $id): void
    {
        $params = $this->getParams($params);

        unset($params['address_id']);

        $this->zipCodeRepository->updte($params, "id = {$id}");
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->zipCodeRepository->destroy($id);
    }
}
