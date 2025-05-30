<?php
session_start();

use ProjetaBD\Auth\ControleDeAcesso;
use ProjetaBD\Enums\Categoria;
use ProjetaBD\Services\EventoServico;
use ProjetaBD\Services\UsuarioServico;
use ProjetaBD\Helpers\Validacoes;

require_once "vendor/autoload.php";

$eventoServico = new EventoServico;

// Obtem a categoria do GET, se houver
$categoria = $_GET['categoria'] ?? null;

if ($categoria && $categoria !== 'Indefinido') {
    // Verifica se a categoria é válida
    $listarEventos = $eventoServico->filtro($categoria);
} else {
    // Se não houver categoria ou for "Indefinido", lista todos os eventos
    $listarEventos = $eventoServico->listarTodos();
}

if (isset($_POST['enviar'])) {
    try {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); 
        $senha = $_POST['senha'];

        // Validações
        Validacoes::validarEmail($email);
        Validacoes::validarSenha($senha);

        $usuarioServico = new UsuarioServico;
        $usuario = $usuarioServico->buscarPorEmail($email);

        if (!$usuario) {
            throw new InvalidArgumentException('Usuário ou senha inválidos!');
        }

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            ControleDeAcesso::login($usuario['id'], $usuario['nome'], $usuario['tipo_usuario'], $usuario['email']);
            header("Location: index.php");
            exit;
        } else {
            throw new InvalidArgumentException('Usuário ou senha inválidos!');
        }

    } catch (InvalidArgumentException $e) {
        header("Location: index.php?tipo=erro");
        exit;
    } catch (Throwable $e) {
        error_log("Erro no login - Email: $email - Erro: " . $e->getMessage());
        header("Location: index.php?tipo=erro");
        exit;
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
    <title>index</title>
</head>

<body>
    <header>
        <div class="header-links">
            <div></div>
            <a href="" class="header-link central">Para você</a>
            <?php if (isset($_SESSION['id'])): ?>
                <a href="logout.php" class="header-link login">Sair</a>
            <?php else: ?>
                <a href="?tipo=login" class="header-link login">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <form id="form-busca" class="botoes-container">
            <i class="fas fa-search"></i>
            <input id="campo-busca" type="text" name="busca" class="barra-pesquisar" placeholder="Digite sua pesquisa...">
        </form>

        <div id="resultados" class="visually-hidden"></div>

        <section class="acoes-index">
             <div class="botoes-container">
                <i class="fas fa-plus"></i>
                <input type="text" class="barra-criar" placeholder="Digite o nome do Projeto" autocomplete="off">
            </div>

             <form method="GET" id="formFiltro" class="filtro-form">
                <div class="botoes-container filtro-container">
                    <select name="categoria" id="categoriaProjeto" class="filtro-select" onchange="document.getElementById('formFiltro').submit();">
                        <?php foreach (\ProjetaBD\Enums\Categoria::cases() as $categoria): ?>
                            <option value="<?= $categoria->name ?>" class="filtro-option" <?= !isset($_GET['categoria']) && $categoria->name === 'Indefinido' ? 'selected' : (isset($_GET['categoria']) && $_GET['categoria'] === $categoria->name ? 'selected' : '') ?>>
                                <?= $categoria->value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fas fa-filter filtro-icon"></i>
                </div>
            </form> 
        </section>

        <section class="feed">
            <?php include 'includes/card.php' ?>
        </section>
    </main>

    <?php include 'includes/nav.php' ?>
    <?php include 'includes/card-modal.php' ?>
    <?php include 'includes/login-modal.php' ?>
    <?php include 'includes/erro.php' ?>
    <?php if (isset($mensagemErro)): ?>
        <div class="mensagem-erro">
            <i class="fas fa-exclamation-circle"></i>
            <?= $mensagemErro ?>
        </div>
    <?php endif; ?>
    


    <script src="js/pages/main.js"></script>
    <script src="js/pages/busca.js"></script>
</body>

</html>