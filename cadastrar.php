<?php
require_once "../pi-back-end/vendor/autoload.php";

use ProjetaBD\Models\Usuario;
use ProjetaBD\Services\UsuarioServico;

$usuarioServico = new UsuarioServico();

 if (isset($_POST['enviar'])) {
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $CPF = filter_input(INPUT_POST, 'CPF', FILTER_SANITIZE_SPECIAL_CHARS);

   $usuario = new Usuario($nome, $email, $senha, $CPF);
   $usuarioServico->inserir($usuario);

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
    <title>Cadastrar</title>
</head>
<body>
    <main>
        <div class="formularios" id="formCadastro">
            <h2>Cadastrar</h2>
            <form id="cadastroForm" method="POST" action="">
                <div class="form">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="form">
                    <label for="CPF">CPF</label>
                    <input type="text" id="CPF" name="CPF">
                    <small class="alerta-cpf">O CPF é opcional, mas necessário para cadastrar eventos ou projetos.</small>
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
