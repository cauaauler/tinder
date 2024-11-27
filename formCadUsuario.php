<?php

require_once __DIR__ . '/vendor/autoload.php';

use CauaAuler\Tinder\Usuario;

if (isset($_POST['botao'])) {
    $u = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);
    $u->save(); 
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuario</title>
</head>

<body>
    <form action='formCadUsuario.php' method='post'>
        <label for='nome'>Nome:</label>
        <input type='text' name='nome' id='nome' required>
        <label for='email'>E-mail:</label>
        <input type='email' name='email' id='email' required>
        <label for='senha'>Senha:</label>
        <input type='password' name='senha' id='senha' required>
        <input type='submit' name='botao' value='Cadastrar'>
    </form>
</body>

</html>
