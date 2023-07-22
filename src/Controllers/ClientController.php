<?php

namespace OpinionBox\Controllers;

use OpinionBox\Services\Client\ClientService;

class ClientController
{
    /**
     * @param ClientService $clientService
     */
    public function __construct(private readonly ClientService $clientService)
    {
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->clientService->index();
    }

    /**
     * @param int $id
     * @return array
     */
    public function show(int $id)
    {
        return $this->clientService->show($id, '*');
    }

    /**
     * @param string $zipCode
     * @return string
     */
    public function searchCep(string $zipCode): string
    {
        return $this->clientService->getZipCodeData($zipCode);
    }

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        return $this->clientService->store($params);
    }

    /**
     * @param array $params
     * @param int $id
     * @return void
     */
    public function update(array $params, int $id): void
    {
        $this->clientService->update($params, $id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->clientService->destroy($id);
    }

    /**
     * @param string $clientName
     * @param string $clientCPF
     * @return array
     */
    public function clientReport(string $clientName, string $clientCPF): array
    {
        return $this->clientService->clientReport($clientName, $clientCPF);
    }

    /**
     * @return array
     */
    public function zipCodesByAddress(): array
    {
        return $this->clientService->zipCodesByAddress();
    }

    /**
     * @return array
     */
    public function addressWithMoreZipCodes(): array
    {
        return $this->clientService->addressWithMoreZipCodes();
    }
}
