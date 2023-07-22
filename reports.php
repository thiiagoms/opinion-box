<?php
    require_once __DIR__ . '/resources/views/header.php';
    require_once __DIR__ . '/bootstrap.php';

    if (isset($_POST['buscar'])) {

        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $clientName   = addslashes($data['nome']);
        $clientCPF    = addslashes($data['cpf']);
        $reportFilter = addslashes($data['reportFilter']);

        if ($reportFilter === 'fullReport') {
            $clientsReport =  $app->clientReport($clientName, $clientCPF);
        }

        if ($reportFilter === 'zipCodeByAddress') {
            $zipCodeByAddressReport = $app->zipCodesByAddress();
        }

        if ($reportFilter === 'addresWithMoreZipCodes') {
            $addressWithMoreZipCodesReport = $app->addressWithMoreZipCodes();
        }
    }
?>

<form class="row g-3" method="post">
    <div class="col-md-6">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe seu nome completo" required>
    </div>
    <div class="col-md-6">
        <label for="cpf" class="form-label">CPF</label>
        <input type="number" class="form-control" id="cpf" name="cpf" placeholder="Informe seu CPF" required>
    </div>
    <div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="reportFilter" id="fullReport" value="fullReport" checked>
            <label class="form-check-label" for="fullReport">
                Relatório Completo
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="reportFilter"
                id="zipCodeByAddress"
                value="zipCodeByAddress"
            >
            <label class="form-check-label" for="zipCodeByAddress">
                Quantidade de Ceps por Bairro
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="reportFilter"
                id="addresWithMoreZipCodes"
                value="addresWithMoreZipCodes"
            >
            <label class="form-check-label" for="addresWithMoreZipCodes">
                Bairros com mais de um CEP
            </label>
        </div>
    <div class="col-md-6 mt-4">
        <button type="submit" class="btn btn-secondary btn-sm"  id="buscar" name="buscar">
            Buscar
        </button>
    </div>
    </div>
</form>

<!--- Full clients reports -->
<?php if(isset($clientsReport)): ?>
<table class="table" aria-label="Listagem de clientes">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Cep</th>
            <th scope="col">Endereço</th>
            <th scope="col">Número</th>
            <th scope="col">Bairro</th>
            <th scope="col">Cidade</th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($clientsReport as $key => $client): ?>
            <tr>
                <td>
                    <?= $client['name']; ?>
                </td>
                <td>
                    <?= $client['cpf']; ?>
                </td>
                <td>
                    <?= $client['zipcode']; ?>
                </td>
                <td>
                    <?= $client['address']; ?>
                </td>
                <td>
                    <?= $client['number']; ?>
                </td>
                <td>
                    <?= $client['neighborhood']; ?>
                </td>
                <td>
                    <?= $client['city']; ?>
                </td>
                <td>
                    <?= $client['state']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- Address with more zipcodes -->
<?php if(isset($zipCodeByAddressReport)): ?>
<table class="table" aria-label="Listagem de clientes">
    <thead>
        <tr>
            <th scope="col">Bairro</th>
            <th scope="col">Quantidade de CEPS vinculados</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($zipCodeByAddressReport as $key => $addressData): ?>
            <tr>
                <td>
                    <?= $addressData['neighborhood']; ?>
                </td>
                <td>
                    <?= $addressData['zipCodesQuantity']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<!-- Address with more than onee zipcodes -->
<?php if (isset($addressWithMoreZipCodesReport)): ?>
<table class="table" aria-label="Listagem de clientes">
    <thead>
    <tr>
        <th scope="col">Bairro</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($addressWithMoreZipCodesReport as $key => $addressWithMoreZipCodes): ?>
        <tr>
            <td>
                <?= $addressWithMoreZipCodes['neighborhood']; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php require_once __DIR__ . '/resources/views/footer.php'; ?>

