<?php

require_once __DIR__ . "/vendor/autoload.php";

use CauaAuler\Tinder\Bolo;

session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("location:index.php");
}

$bolos = Bolo::findAllRanking();
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
</body>
</html>