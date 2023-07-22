<?php

require_once __DIR__ . '/vendor/autoload.php';

use OpinionBox\Helpers\{ContainerDI, Env};
use OpinionBox\Repositories\{
    Address\AddressRepository,
    Client\ClientRepository,
    ZipCode\ZipCodeRepository
};
use OpinionBox\Services\{
    Address\AddressService,
    ZipCode\ZipCodeService,
    Client\ClientService
};
use OpinionBox\Controllers\ClientController;

Env::load();

$container = new ContainerDI();

// Repositories
$container->set('ZipCodeRepository', fn(): ZipCodeRepository => new ZipCodeRepository());
$container->set('ClientRepository', fn(): ClientRepository => new ClientRepository());
$container->set('AddressRepository', fn(): AddressRepository => new AddressRepository());

// Services
$container->set('AddressService', fn(object $container): AddressService => new AddressService(
    $container->get('AddressRepository')
));

$container->set('ZipCodeService', fn(object $container): ZipCodeService => new ZipCodeService(
    $container->get('ZipCodeRepository')
));

$container->set('ClientService', fn(object $container): ClientService => new ClientService(
    $container->get('AddressService'),
    $container->get('ZipCodeService'),
    $container->get('ClientRepository')
));

// Controllers
$container->set('ClientController', fn(object $container): ClientController => new ClientController(
    $container->get('ClientService')
));

/** @var ClientController $app */
$app = $container->get('ClientController');
