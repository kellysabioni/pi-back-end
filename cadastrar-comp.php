<?php
require_once "../pi-back-end/vendor/autoload.php";

use ProjetaBD\Models\Usuario;
use ProjetaBD\Services\UsuarioServico;

$usuarioServico = new UsuarioServico();

 if (isset($_POST['enviar'])) {
   $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
   $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
   $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);

   $usuario = new Usuario($id, $cpf, $data_nascimento);
   $usuarioServico->completarCadastro($usuario);

   header("location:index.php");
   exit;
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Complete o cadastro</title>
</head>
<body>
    <main>
        <div class="formularios" id="formCadastro">
            <h2>Por favor, complete seu cadastro</h2>
            <form id="cadastroForm" method="POST" action="">
                <div class="form">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>
                <div class="form">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>
                
                <div class="form">
                    <button name="enviar" type="submit" class="btnEnviar">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>
    <?php include 'includes/nav.php'; ?>
</body>
</html>
