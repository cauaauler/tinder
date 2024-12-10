<?php

require_once __DIR__ . "/vendor/autoload.php";

use Guy\Tinder\Bolo;
use Guy\Tinder\Bolo_usuario;
use Guy\Tinder\MySQL;

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
    <title>Página Inicial</title>
</head>

<body>
    <header>
        <h1 class="titulo">BOLOS</h1>
        <a href='sair.php'>Sair</a>
        <a href='ranking.php'>Ranking</a>

        <?php
        //Provavelmente não é nem um pouco seguro
        if($_SESSION['idUsuario'] == 1){
            echo "<a href='formCadBolo.php'>Cadastrar novo bolo</a>";
            echo "<a href='viewBolos.php'>Todos os Bolos</a>";
        }
        ?>
    </header>

    <main>
        <div class="container">
            <div class="bolo">
                <?php
                if (!$avaliacaoExistente) {
                    // Exibe o bolo atual se não foi avaliado
                    $bolo = Bolo::find($boloAtual);
                    echo "<h1 class='bolo-titulo'>" . $bolo->getNome() . "</h1>";
                    // echo "<p>" . $bolo->getVotos() . " votos</p>";
                    // echo "<p>" . $bolo->getSabor() . "</p>";
                    echo "<p>" . $bolo->getDescricao() . "</p>";
                    echo "<img src='" . $bolo->getImagem() . "' alt='" . $bolo->getNome() . "' class='bolo-imagem'>";
                    echo "<div class='botoes_avaliacao'>";
                    echo "<a href='restrita.php?idBolo=" . $bolo->getId() . "&voto=1'>COMERIA</a>";
                    echo "<a href='restrita.php?idBolo=" . $bolo->getId() . "&voto=0'>NÃO COMERIA</a>";
                    echo "</div>";
                } else {
                    echo "<p>A boleria está fechada, os bolos acabaram!</p>";
                }
                ?>
            </div>

        </div>
    </main>

</body>

</html>