    <?php

    require_once __DIR__ . '/vendor/autoload.php';

    use Guy\Tinder\Usuario;

    if (isset($_POST['botao'])) {
        $usuarios = Usuario::findAll();

        // Extrair emails usando array_map
        $emails = array_map(fn($usuario) => $usuario->getEmail(), $usuarios);

        if (in_array($_POST['email'], $emails)) {
            $mensagem = "Email já cadastrado";
        } else if (strpos($_POST['email'], '@aluno.feliz.ifrs.edu.br') !== false) {
            $u = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);
            $u->save();
            header("location: index.php");
            exit;
        } else {
            $mensagem = "Somente emails do IFRS(@aluno.feliz.ifrs.edu.br) são permitidos";
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
        <title>Adicionar Usuario</title>
    </head>

    <body class="login">
        <div class="container">
            <?php if (isset($mensagem)) : ?>
                <p><?= $mensagem ?></p>
            <?php endif ?>
            <form action='formCadUsuario.php' method='post'>
                <label for='nome'>Nome:</label>
                <input type='text' name='nome' id='nome' required>
                <label for='email'>E-mail:</label>
                <input type='email' name='email' id='email' required>
                <label for='senha'>Senha:</label>
                <input type='password' name='senha' id='senha' required>
                <input type='submit' name='botao' value='Cadastrar'>
                <a value="Voltar" href="index.php" class="dandadan" id="voltar-btn">Voltar</a>

            </form>
        </div>
    </body>

    </html>