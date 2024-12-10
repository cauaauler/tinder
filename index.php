<?php

namespace Guy\Tinder;

require_once __DIR__ . "/vendor/autoload.php";

if (isset($_POST['botao'])) {
    require_once __DIR__ . "/vendor/autoload.php";
    $u = new Usuario("", $_POST['email'], $_POST['senha']);
    if ($u->authenticate()) {
        header("location: restrita.php");
    } else {
        echo "Usuario ou senha incorretos";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login de usuário</title>
</head>

<body class="login">
    <div class="container">
        <form action='index.php' method='post'>
            <label for='email'>E-mail:</label>
            <input type='email' name='email' id='email' required>
            <label for='senha'>Senha:</label>
            <input type='password' name='senha' id='senha' required>
            <input type='submit' name='botao' value='Acessar'>
            <a href='formCadUsuario.php' class="kkkk">Cadastrar usuario</a>
        </form>
    </div>
</body>

</html>