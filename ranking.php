<?php

require_once __DIR__ . "/vendor/autoload.php";

use Guy\Tinder\Bolo;

session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("location:index.php");
}
if (isset($_GET['order'])) {
    $bolos = Bolo::findAllRanking($_GET['order']);
} else {
    $bolos = Bolo::findAllRanking();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ranking de Votação</title>
</head>

<body>
    <header>
        <div class="order-by-container">
            <h1 class="titulo">RANKING</h1>

            <form class="order-by" method="get" action="ranking.php">
                <label for="order">Ordenar por votos:</label>
                <select name="order" id="order" onchange="this.form.submit()">
                    <option <?php echo !isset($_GET['order']) || $_GET['order'] == 'DESC' ? 'selected' : ''; ?> value="DESC">Do maior para o menor</option>
                    <option <?php echo isset($_GET['order']) && $_GET['order'] == 'ASC' ? 'selected' : ''; ?> value="ASC">Do menor para o maior</option>
                </select>
            </form>
        </div>
    </header>



    <table class="ranking-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Votos</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($bolos as $bolo) {
                echo "<tr>";
                echo "<td class='bolo-nome'>" . htmlspecialchars($bolo->getNome()) . "</td>";
                echo "<td class='bolo-votos'>" . htmlspecialchars($bolo->getVotos()) . " votos</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <a value="Voltar" href="restrita.php" class="dandadan" id="voltar-btn">Voltar</a>
</body>

</html>