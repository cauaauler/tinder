<?php

use CauaAuler\Tinder\Usuario;

session_start();
if(!isset($_SESSION['idUsuario'])){
    header("location:index.php");
}
require_once __DIR__."/vendor/autoload.php";

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
<table>
    
    <?php
    
    ?>
</table>
<a href='formCadPessoa.php'>Adicionar Contato</a> | 
<a href='sair.php'>Sair</a>
</body>
</html>






