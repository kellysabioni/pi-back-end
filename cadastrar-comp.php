<?php
session_start();

require_once "../pi-back-end/vendor/autoload.php";

use ProjetaBD\Models\Usuario;
use ProjetaBD\Services\UsuarioServico;
use ProjetaBD\Auth\ControleDeAcesso;

// Verifica se o usuário está logado
ControleDeAcesso::exigirLogin();

$usuarioServico = new UsuarioServico();

if (isset($_POST['enviar'])) {
    $id = $_SESSION['id'];
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);

    try {
        $usuario = new Usuario(
            $_SESSION['nome'], $_SESSION['email'], '','cadastro', $id, $cpf, $data_nascimento
        );
        
       // Atualiza o tipo de usuário na sessão
        $_SESSION['tipo'] = 'cadastro';

        $usuarioServico->completarCadastro($usuario);
        header("location:index.php");
        exit;
    } catch (Throwable $erro) {
        echo "<script>alert('Erro ao completar cadastro: " . $erro->getMessage() . "');</script>";
    }
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
                    <label for="cpf">CPF <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>
                <div class="form">
                    <label for="data_nascimento">Data de Nascimento <span class="campo-obrigatorio">*</span></label>
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
