<?php

require_once __DIR__ . "/vendor/autoload.php";

use CauaAuler\Tinder\Bolo;
use CauaAuler\Tinder\Bolo_usuario;
use CauaAuler\Tinder\MySQL;

session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("location:index.php");
}

// Verifica qual o primeiro bolo que o usuário ainda não avaliou
$boloAtual = 1; // Valor padrão, caso o usuário tenha avaliado todos os bolos

// Consulta para encontrar o primeiro bolo que o usuário ainda não avaliou
$sql = "SELECT b.idBolo
        FROM bolo b
        WHERE NOT EXISTS (
            SELECT 1
            FROM bolo_usuario bu
            WHERE bu.idBolo = b.idBolo AND bu.idUsuario = {$_SESSION['idUsuario']} 
        )
        LIMIT 1";

    // Executa a consulta usando o idUsuario
    $mysql = new MySQL();
    $resultado = $mysql->consulta($sql);
// Se houver resultados, define o boloAtual como o primeiro bolo não avaliado
if (count($resultado) > 0) {
    $boloAtual = $resultado[0]['idBolo'];
}

// Verifica se o usuário já avaliou o bolo atual
$avaliacaoExistente = Bolo_usuario::findByUserAndBolo($_SESSION['idUsuario'], $boloAtual);

if (isset($_GET['idBolo']) && !$avaliacaoExistente) {
    $bolo = Bolo::find($boloAtual);
    $bolo->setVotos($bolo->getVotos() + 1);
    $bolo->save();

    // Salva a avaliação do usuário
    $boloUsuario = new Bolo_usuario($_GET['voto'], $_SESSION['idUsuario'], $bolo->getId());
    $boloUsuario->save();

    // Atualiza o boloAtual
    $boloAtual += 1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Página de Contatos</title>
</head>

<body>
    <h1>Hoje eu inventei de fazer um bolo ó™</h1>

    <?php
    if (!$avaliacaoExistente) {
        // Exibe o bolo atual se não foi avaliado
        $bolo = Bolo::find($boloAtual);
        echo "<div>";
        echo "<p>" . $bolo->getNome() . "</p>";
        echo "<p>" . $bolo->getVotos() . " votos</p>";
        echo "<p>" . $bolo->getSabor() . "</p>";
        echo "<p>" . $bolo->getDescricao() . "</p>";
        echo "</div>";

        echo "<div>";
        echo "<a href='restrita.php?idBolo=" . $bolo->getId() . "&voto=1'>Comeria</a>";
        echo "<a href='restrita.php?idBolo=" . $bolo->getId() . "&voto=0'>Não comeria</a>";
        echo "</div>";
    } else {
        echo "<p>A padaria está fechada, os bolos acabaram!</p>";
    }
    ?>

    <a href='sair.php'>Sair</a>
</body>

</html>