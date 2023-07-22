<?php

declare(strict_types=1);

namespace OpinionBox\Services\Client;

use OpinionBox\Repositories\Client\ClientRepository;
use OpinionBox\Services\{
    Address\AddressService,
    ZipCode\ZipCodeService
};
use OpinionBox\Services\Service;

class ClientService extends Service
{

    public function __construct (
        private readonly AddressService $addressService,
        private readonly ZipCodeService $zipCodeService,
        private ClientRepository        $clientRepository
    )
    {
    }

    /**
     * @param array $params
     * @return array
     */
    private function getParams(array $params): array
    {
        return ['name' => $params['nome'], 'cpf'  => $params['cpf']];
    }

    /**
     * @param string $cep
     * @return string|false
     */
    public function getZipCodeData(string $cep): bool|string
    {
        return json_encode($this->zipCodeService->searchZipCode($cep), JSON_PRETTY_PRINT);
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->clientRepository
            ->getClientsWithCep('clients.id, clients.name, clients.cpf, zipcodes.zipcode');
    }

    /**
     * @param int $id
     * @return array
     */
    public function show(int $id, ?string $fields = null): array
    {
        $fields = is_null($fields) ? '*' : $fields;
        return $this->clientRepository->getClientsWithCep($fields, "clients.id = {$id}");
    }

    /**
     * @param array $params
     * @return array
     */
    public function store(array $params): array
    {
        $params = array_map(fn (string $field): string => $this->cleanFields($field), $params);

        $clientId  = $this->clientRepository->create($this->getParams($params));

        $params = array_merge(['client_id' => $clientId], $params);
        $addressId = $this->addressService->create($params);

        $params = array_merge(['address_id' => $addressId], $params);
        $this->zipCodeService->create($params);

        return is_integer($clientId)
            ? ['status' => 'success', 'message' => 'Cliente cadastrado com sucesso']
            : ['status' => 'failure', 'message' => 'Falha ao cadastrar cliente'];
    }

    /**
     * @param array $params
     * @param int $id
     * @return void
     */
    public function update(array $params, int $id): void
    {
        $params = array_map(fn (string $field): string => $this->cleanFields($field), $params);

        $clientData = $this->show($id, "clients.id AS id, address.id AS id_address, zipcodes.id AS id_zipcode")[0];

        $clientFields = $this->getParams($params);

        $this->clientRepository->updte($clientFields, "id = {$id}");

        $this->addressService->update($params, $clientData['id_address']);
        $this->zipCodeService->update($params, $clientData['id_zipcode']);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $clientData = $this->show($id, "clients.id AS id, address.id AS id_address, zipcodes.id AS id_zipcode")[0];

        $this->zipCodeService->destroy($clientData['id_zipcode']);
        $this->addressService->destroy($clientData['id_address']);

        $this->clientRepository->destroy($clientData['id']);
    }

    /**
     * @return array|bool
     */
    public function clientReport(string $clientName, string $clientCPF)
    {
        return $this->clientRepository
            ->getClientsWithCep('*', "clients.name = '{$clientName}' AND clients.cpf = '{$clientCPF}'");
    }

    /**
     * @return array
     */
    public function zipCodesByAddress(): array
    {
        return $this->addressService->getZipCodesByAddress();
    }

    /**
     * @return array
     */
    public function addressWithMoreZipCodes(): array
    {
        return $this->addressService->getAddressWithMoreZipCodes();
    }
}
