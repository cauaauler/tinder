<?php

require_once __DIR__ . '/vendor/autoload.php';

use Guy\Tinder\Bolo;

if (isset($_POST['botao'])) {
    $id = $_POST['id'];
    $bolo = Bolo::find($id);
    $bolo->setNome($_POST['nome']);
    $bolo->setSabor($_POST['sabor']);
    $bolo->setDescricao($_POST['descricao']);

    // Verifica se foi enviado um arquivo de imagem
    if ($_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        // Processa a nova imagem
        $imagem = $_FILES['imagem'];
        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $permitidas = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];

        if (in_array(strtolower($extensao), $permitidas)) {
            $caminhoImagem = 'uploads/' . uniqid() . '.' . $extensao;
            move_uploaded_file($imagem['tmp_name'], $caminhoImagem);
            $bolo->setImagem($caminhoImagem);
        } else {
            $mensagem = "Formato de imagem não permitido. Os formatos permitidos são JPG, JPEG, PNG, JFIF e WEBP.";
        }
    }

    // Salva as alterações do bolo
    $bolo->save();
    header("location: restrita.php");
    exit;
}

$id = $_GET['id'];
$bolo = Bolo::find($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Bolo</title>

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

<form action='formEditBolo.php' method='post' enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $bolo->getId(); ?>">
    
    <label for='nome'>Nome:</label>
    <input type='text' name='nome' id='nome' value="<?php echo $bolo->getNome(); ?>" required>
    
    <label for='sabor'>Sabor:</label>
    <input type='text' name='sabor' id='sabor' value="<?php echo $bolo->getSabor(); ?>" required>
    
    <label for='descricao'>Descrição:</label>
    <input type='text' name='descricao' id='descricao' value="<?php echo $bolo->getDescricao(); ?>" required>
    
    <label for='imagem'>Imagem:</label>
    <input type='file' name='imagem' id='imagem'>
    
    <input type='submit' name='botao' value='Editar'>
</form>

<input type="button" value="Voltar" onclick="window.location.href = 'restrita.php';">
</body>

</html>
