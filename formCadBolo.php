<?php

require_once __DIR__ . '/vendor/autoload.php';

use CauaAuler\Tinder\Bolo;

if (isset($_POST['botao'])) {
    $bolos = Bolo::findAll();

    // Extrair nomes usando array_map
    $nomes = array_map(fn($bolo) => $bolo->getNome(), $bolos);

    if (in_array($_POST['nome'], $nomes)) {
        $mensagem = "Bolo já cadastrado";
    } else {
        $imagem = $_FILES['imagem'];
        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $permitidas = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];

        if ($imagem['error'] !== UPLOAD_ERR_OK) {
            $mensagem = "Erro ao fazer upload da imagem";
        } elseif (!in_array(strtolower($extensao), $permitidas)) {
            $mensagem = "Formato de imagem não permitido";
        } else {
            $caminhoImagem = 'uploads/' . uniqid() . '.' . $extensao;
            move_uploaded_file($imagem['tmp_name'], $caminhoImagem);
            $b = new Bolo($_POST['nome'], $_POST['votos'] = 0, $_POST['sabor'], $_POST['descricao'], $caminhoImagem);
            $b->save();
            header("location: index.php");
            exit;
        }
        }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Bolo</title>

    <script>
        function validarImagem() {
            const imagemInput = document.getElementById('imagem');
            const arquivo = imagemInput.files[0];
            if (arquivo) {
                const extensao = arquivo.name.split('.').pop().toLowerCase();
                const extensoesPermitidas = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
                
                if (!extensoesPermitidas.includes(extensao)) {
                    alert('Formato de imagem não permitido. Os formatos permitidos são JPG, JPEG, PNG, JFIF e WEBP.');
                    imagemInput.value = ''; // Limpa o arquivo selecionado
                }
            }
        }

        // Validação ao selecionar um arquivo
        document.addEventListener('DOMContentLoaded', function() {
            const imagemInput = document.getElementById('imagem');
            imagemInput.addEventListener('change', validarImagem);
        });
    </script>
</head>

<body>

<?php if (isset($mensagem)) : ?>
    <p><?= $mensagem ?></p>
<?php endif ?>
<form action='formCadBolo.php' method='post' enctype='multipart/form-data'>
    <label for='nome'>Nome:</label>
    <input type='text' name='nome' id='nome' required>
    <label for='sabor'>Sabor:</label>
    <input type='text' name='sabor' id='sabor' required>
    <label for='descricao'>Descricao:</label>
    <input type='text' name='descricao' id='descricao' required>
    <label for='imagem'>Imagem:</label>
    <input type='file' name='imagem' id='imagem' required>
    <input type='submit' name='botao' value='Cadastrar'>
</form>
<input type="button" value="Voltar" onclick="window.location.href = 'restrita.php';">
</body>

</html>