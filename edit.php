<?php

require_once __DIR__ . '/resources/views/header.php';
require_once __DIR__ . '/bootstrap.php';

if (isset($_GET['id'])) {

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        $result = ['status' => 'error', 'message' => "Id {$id} Inválido"];
    } else {
        $client = $app->show($id)[0];
    }
}

if (isset($_POST['atualizar'])) {

    $data = filter_input_array(INPUT_POST , FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$data) {
        $result = ['status' => 'error', 'message' => 'Falha no cadastro, tente novamente mais tarde!!'];
    } else {
        $app->update($data, $id);
        header('Location: list.php');
    }
}
?>

<?php if (isset($result) && $result['status'] === 'error'): ?>
    <div class="alert alert-danger" role="alert">
        <?= $result['message']; ?>
    </div>
<?php endif; ?>

<?php if (isset($client)): ?>
<form class="row g-3" method="post">
    <div class="col-md-6">
        <label for="nome" class="form-label">Nome</label>
        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            value="<?= $client['name']; ?>"
            placeholder="Informe seu nome completo"
            required
        >
    </div>
    <div class="col-md-6">
        <label for="cpf" class="form-label">CPF</label>
        <input
            type="number"
            class="form-control"
            id="cpf"
            name="cpf"
            placeholder="Informe seu CPF"
            value="<?= $client['cpf']; ?>"
            required
        >
    </div>
    <div class="col-md-6">
        <label for="cep" class="form-label">CEP</label>
        <div class="input-group">
            <input
                type="number"
                class="form-control"
                name="cep"
                id="cep"
                value="<?= $client['zipcode']; ?>"
                placeholder="Clique no ícone ao lado para buscar seu endereço"
                required
            >
            <div class="input-group-append">
                <button type="button" class="btn btn-secondary" id="searchCep">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="numero" class="form-label">Número</label>
        <input
            type="text"
            class="form-control"
            id="numero"
            name="numero"
            value="<?= $client['number']; ?>"
            placeholder="Informe o número da sua residência"
            required
        >
    </div>
    <div class="col-md-6">
        <label for="rua" class="form-label">Rua</label>
        <input
            type="text"
            class="form-control"
            id="rua"
            name="rua"
            value="<?= $client['address']; ?>"
            placeholder="Informe o nome da sua rua"
            required
        >
    </div>
    <div class="col-md-6">
        <label for="bairro" class="form-label">Bairro</label>
        <input
            type="text"
            class="form-control"
            id="bairro"
            name="bairro"
            value="<?= $client['neighborhood']; ?>"
            placeholder="Informe o nome do seu bairro"
            required
        >
    </div>
    <div class="col-md-6">
        <label for="cidade" class="form-label">Cidade</label>
        <input
            type="text"
            class="form-control"
            id="cidade"
            name="cidade"
            value="<?= $client['city']; ?>"
            placeholder="Informe o nome da sua cidade"
            required
        >
    </div>
    <div class="col-md-6">
        <label for="estado" class="form-label">Estado</label>
        <input
            type="text"
            class="form-control"
            id="estado"
            name="estado"
            value="<?= $client['state']; ?>"
            placeholder="Informe a UF do seu Estado"
            required
        >
    </div>
    <div class="col-md-6">
        <button type="submit" class="btn btn-primary btn-sm"  id="atualizar" name="atualizar">
            Atualizar
        </button>
    </div>
</form>
<?php endif; ?>

<?php require_once __DIR__ . '/resources/views/footer.php'; ?>
