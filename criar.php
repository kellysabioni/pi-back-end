<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Criar</title>
</head>

<body>
<div class="criar-botoes">
    <a href="?tipo=evento">
        <button id="btnEvento" class="criar-botao <?php
            echo (!isset($_GET['tipo']) || $_GET['tipo'] === 'evento') ? 'ativo' : '';
        ?>">
            Novo Evento
        </button>
    </a>
    <a href="?tipo=projeto">
        <button id="btnProjeto" class="criar-botao <?php
            echo (isset($_GET['tipo']) && $_GET['tipo'] === 'projeto') ? 'ativo' : '';
        ?>">
            Novo Projeto
        </button>
    </a>
</div>


    <?php
        $tipo = $_GET['tipo'] ?? 'evento';

        if (isset($_GET['tipo'])) {
            if ($_GET['tipo'] === 'evento') {
                include 'includes/inserirEvento.php';
            } elseif ($_GET['tipo'] === 'projeto') {
                include 'includes/inserirProjeto.php';
            }
        }
    ?>

    <?php include 'includes/nav.php' ?>
    <script src="https://unpkg.com/imask"></script>
    <script type="module" src="js/pages/criar.js"></script>
</body>
</html>