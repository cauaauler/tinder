<?php

require_once __DIR__ . '/vendor/autoload.php';

use CauaAuler\Tinder\Bolo;

if (isset($_POST['botao'])) {
    $id = $_POST['id'];
    $bolo = Bolo::find($id);
    $bolo->delete();
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
    <title>Excluir Bolo</title>
</head>

<body>

<?php if (isset($mensagem)) : ?>
    <p><?= $mensagem ?></p>
    <?php endif ?>

    <h2>Tem certeza que deseja excluir o <?= $bolo->getNome() ?>?</h2>
    <form action='deleteBolo.php' method='post'>
        <input type="hidden" name="id" value="<?php echo $bolo->getId(); ?>">
        <input type='submit' name='botao' value='Excluir'>
    </form>
</body>

</html>