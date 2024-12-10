<?php

require_once __DIR__ . '/vendor/autoload.php';

use Guy\Tinder\Bolo;

$bolos = Bolo::findAll();

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Bolos</title>
</head>

<body>

<h1>Lista de Bolos</h1>

<a href='formCadBolo.php'>Cadastrar novo bolo</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Votos</th>
        <th>Sabor</th>
        <th>Descrição</th>
        <th>Imagem</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($bolos as $bolo) : ?>
        <tr>
            <td><?= $bolo->getId() ?></td>
            <td><?= $bolo->getNome() ?></td>
            <td><?= $bolo->getVotos() ?></td>
            <td><?= $bolo->getSabor() ?></td>
            <td><?= $bolo->getDescricao() ?></td>
            <td><?= $bolo->getImagem() ?></td>
            <td>
                <a href="formEditBolo.php?id=<?= $bolo->getId() ?>">Editar bolo</a>
                <a href="deleteBolo.php?id=<?= $bolo->getId() ?>">Excluir bolo</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>
<a href="restrita.php" class="dandadan" id="voltar-btn">Voltar</a>

</body>

</html>