<?php
require_once __DIR__ . '/resources/views/header.php';
require_once __DIR__ . '/bootstrap.php';

$clients = $app->index();

?>

<table class="table" aria-label="Listagem de clientes">
    <thead>
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Cep</th>
        <th scope="col">Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($clients as $key => $client): ?>
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
                <a href="edit.php?id=<?= $client['id']; ?>" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen-nib"></i>
                </a>
                <a href="delete.php?id=<?= $client['id']; ?>" class="btn btn-danger btn-sm">
                    <i class="fa-solid fa-circle-xmark"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/resources/views/footer.php'; ?>
