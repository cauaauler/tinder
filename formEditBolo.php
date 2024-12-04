<?php

require_once __DIR__ . '/vendor/autoload.php';

use CauaAuler\Tinder\Bolo;

if (isset($_POST['botao'])) {
    $id = $_POST['id'];
    $bolo = Bolo::find($id);
    $bolo->setNome($_POST['nome']);
    $bolo->setSabor($_POST['sabor']);
    $bolo->setDescricao($_POST['descricao']);
    $bolo->setImagem($_POST['imagem']);
    $bolo->save();
    header("location: index.php");
    exit;
}

$id = $_GET['id'];
$bolo = Bolo::find($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bolo</title>
</head>

<body>

<?php if (isset($mensagem)) : ?>
    <p><?= $mensagem ?></p>
    <?php endif ?>

    <form action='formEditBolo.php' method='post'>
        <input type="hidden" name="id" value="<?php echo $bolo->getId(); ?>">
        <label for='nome'>Nome:</label>
        <input type='text' name='nome' id='nome' value="<?php echo $bolo->getNome(); ?>" required>
        <label for='sabor'>Sabor:</label>
        <input type='text' name='sabor' id='sabor' value="<?php echo $bolo->getSabor(); ?>" required>
        <label for='descricao'>Descricao:</label>
        <input type='text' name='descricao' id='descricao' value="<?php echo $bolo->getDescricao(); ?>" required>
        <label for='imagem'>Imagem:</label>
        <input type='text' name='imagem' id='imagem' value="<?php echo $bolo->getImagem(); ?>" required>
        <input type='submit' name='botao' value='Editar'>
    </form>
    <input type="button" value="Voltar" onclick="window.location.href = 'restrita.php';">
</body>

</html>