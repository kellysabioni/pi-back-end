<?php
session_start();

require_once "vendor/autoload.php";

use ProjetaBD\Models\Usuario;
use ProjetaBD\Services\UsuarioServico;
use ProjetaBD\Auth\ControleDeAcesso;

// Verifica se o usuário está logado
ControleDeAcesso::exigirLogin();

$usuarioServico = new UsuarioServico();

/* if (isset($_POST['enviar'])) {
    $id = $_SESSION['id'];
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);

    $usuarioServico->validarCPF($cpf);

    $usuarioServico->validarDataNascimento($data_nascimento, $)


    try {
        $usuario = new Usuario(
            $_SESSION['nome'],
            $_SESSION['email'],
            '', 
            'cadastro',
            $id,
            $cpf,
            $data_nascimento
        );
        
        $usuarioServico->completarCadastro($usuario);

        $_SESSION['tipo'] = 'cadastro';
        header("location:index.php");
        exit;
    } catch (Throwable $erro) {
        $mensagemErro = "Erro ao completar cadastro: " . $erro->getMessage();
    }
} */

if (isset($_POST['enviar'])) {
    $id = $_SESSION['id'];
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);

    $mensagemErro = "";

    // Validações
    $cpfValido = $usuarioServico->validarCPF($cpf);
    
    $dataValida = $usuarioServico->validarDataNascimento();

    if ($cpfValido !== true) {
        $mensagemErro = $cpfValido;
    } elseif ($dataValida !== true) {
        $mensagemErro = $dataValida;

    } else {
        try {
            $usuario = new Usuario(
                $_SESSION['nome'],
                $_SESSION['email'],
                '', 
                'cadastro',
                $id,
                $cpf,
                $data_nascimento
            );

            $usuarioServico->completarCadastro($usuario);

            $_SESSION['tipo'] = 'cadastro';
            header("location:index.php");
            exit;
        } catch (Throwable $erro) {
            $mensagemErro = "Erro ao completar cadastro: " . $erro->getMessage();
        }
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
                    <input type="text" id="cpf" name="cpf" required maxlength="14">
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

    <script>
document.getElementById('cpf').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não for número

    if (value.length > 11) value = value.slice(0, 11); // Limita a 11 dígitos

    // Aplica a máscara
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    e.target.value = value;
});
</script>

</body>
</html>
