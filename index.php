<?php

use ProjetaBD\Enums\Categoria;
use ProjetaBD\Services\EventoServico;

require_once "../pi-back-end/vendor/autoload.php";

$eventoServico = new EventoServico;

// Obtem a categoria do GET, se houver
$categoria = $_GET['categoria'] ?? null;

if ($categoria && $categoria !== Categoria::Indefinido->value) {
    // Aplica o filtro normalmente, exceto se for "Indefinido"
    $listarEventos = $eventoServico->filtro($categoria);
} else {
    // Se for "Indefinido" ou nulo, mostra todos
    $listarEventos = $eventoServico->listarTodos();
}

use ProjetaBD\Services\UsuarioServico;

$usuarioServico = new UsuarioServico();

if (isset($_POST['entrar'])) {
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    $usuario = $usuarioServico->validarLogin($email, $senha);
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
        <div>
            <div class="header-links">
                <a href="" class="header-link">Para você</a>
                <a href="" class="header-link">Seguindo</a>
                <a href="index.php?tipo=login" class="header-link">Login</a>
            </div>
        </div>
    </header>
    <main>
        <section class="acoes-index">
            <div class="botoes-container">
                <button class="botao botao-pesquisa" onclick="barraPesquisar()">
                    <i class="fas fa-search"></i>
                </button>

                <form id="form-busca" class="" autocomplete="off" method="POST" onsubmit="return false;">
                    <input id="campo-busca" type="text" name="busca" class="barra-pesquisar ativo" placeholder="Digite sua pesquisa...">
                </form>
            </div>

            <div id="resultados" class="visually-hidden"></div>


            <div class="botoes-container">
                <button class="botao botao-criar" onclick="barraCriar()">
                    <i class="fas fa-plus"></i>
                </button>
                <input type="text" class="barra-criar" placeholder="Digite o nome do Projeto" onkeypress="">
            </div>

            <form method="GET" id="formFiltro">
                <div class="botoes-container">
                    <select name="categoria" id="categoriaProjeto" onchange="document.getElementById('formFiltro').submit();">
                        <?php foreach (\ProjetaBD\Enums\Categoria::cases() as $categoria): ?>
                            <option value="<?= $categoria->value ?>" <?= isset($_GET['categoria']) && $_GET['categoria'] === $categoria->value ? 'selected' : '' ?>>
                                <?= $categoria->value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fas fa-filter"></i>
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