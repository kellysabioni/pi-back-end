<?php
session_start();

use ProjetaBD\Auth\ControleDeAcesso;
use ProjetaBD\Enums\Categoria;
use ProjetaBD\Services\EventoServico;

require_once "../pi-back-end/vendor/autoload.php";

$eventoServico = new EventoServico;

// Obtem a categoria do GET, se houver
$categoria = $_GET['categoria'] ?? null;

if ($categoria && $categoria !== Categoria::Indefinido->value) {
  
    $listarEventos = $eventoServico->filtro($categoria);
} else {
   
    $listarEventos = $eventoServico->listarTodos();
}

use ProjetaBD\Services\UsuarioServico;

if (isset($_POST['enviar'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); 
    $senha = $_POST['senha'];

    if (!$email || empty($senha)) {
        echo "<script>alert('Campos vazios');</script>";
        exit;
    }

    try {
        $usuarioServico = new UsuarioServico;
        $usuario = $usuarioServico->buscarPorEmail($email);

        if (!$usuario) {
            echo "<script>alert('Usuário ou senha inválidos!');</script>";
            exit;
        }

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            ControleDeAcesso::login($usuario['id'], $usuario['nome'], $usuario['tipo_usuario'], $usuario['email']);
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta');</script>";
            exit;
        }

    } catch (Throwable $erro) {
        echo "<script>alert('Erro no login - Email: $email - Erro: " . $erro->getMessage() . "');</script>";
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
        <?php if (isset($_SESSION['id'])): ?>
            <p>Bem vindo, <?php echo $_SESSION['nome']; echo $_SESSION['tipo']; ?></p>
        <?php endif; ?>
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
                    <select name="categoria" id="categoriaProjeto" class="filtro-select" onchange="if(this.value === 'Selecione uma categoria') { window.location.href = 'index.php'; } else { document.getElementById('formFiltro').submit(); }">
                        <?php foreach (\ProjetaBD\Enums\Categoria::cases() as $categoria): ?>
                            <option value="<?= $categoria->value ?>" class="filtro-option" <?= isset($_GET['categoria']) && $_GET['categoria'] === $categoria->value ? 'selected' : '' ?>>
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

    <script src="js/pages/main.js"></script>
    <script src="js/pages/busca.js"></script>
</body>

</html>