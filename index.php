<?php

use ProjetaBD\Services\EventoServicos;

require_once "../pi-back-end/vendor/autoload.php";

$eventoServico = new EventoServicos;
$listarEventos = $eventoServico->listarTodos();
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
            </div>
        </div>
    </header>
    <main>
        <section class="acoes-index">
            <div class="botoes-container">
                <button class="botao botao-pesquisa" onclick="barraPesquisar()">
                    <i class="fas fa-search"></i>
                </button>
                <input type="text" class="barra-pesquisar ativo" placeholder="Digite sua pesquisa...">
            </div>
            <div class="botoes-container">
                <button class="botao botao-criar" onclick="barraCriar()">
                    <i class="fas fa-plus"></i>
                </button>
                <input type="text" class="barra-criar" placeholder="Digite o nome do Projeto" onkeypress="">
            </div>
        </section>
        <section class="feed">
            <?php include 'includes/card.php' ?>
        </section>
    </main>

    <?php include 'includes/nav.php' ?>
    <?php include 'includes/card-modal.php' ?>

    <script src="js/pages/main.js"></script>

</body>

</html>