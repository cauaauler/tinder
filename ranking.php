<?php

require_once __DIR__ . "/vendor/autoload.php";

use CauaAuler\Tinder\Bolo;

session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("location:index.php");
}
if (isset($_GET['order'])) {
    $bolos = Bolo::findAllRanking($_GET['order']);
}else{
    $bolos = Bolo::findAllRanking();

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($bolos as $bolo) {
        echo "<p>" . $bolo->getNome() . "</p>";
        echo "<p>" . $bolo->getVotos() . " votos</p>";
    }
    ?>
    <form method="get" action="ranking.php">
        <select name="order" id="order" onchange="this.form.submit()">
            <option <?php echo !isset($_GET['order']) || $_GET['order'] == 'DESC' ? 'selected' : ''; ?> value="DESC">Do maior para o menor</option>
            <option <?php echo isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'selected' : ''; ?> value="ASC">Do menor para o maior</option>
        </select>
    </form>
    <a href="restrita.php">Voltar</a>
</body>

</html>