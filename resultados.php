<?php
/* Este arquivo é usado em conjunto com o js/busca.js */

use ProjetaBD\Services\EventoServico;

require_once "../pi-back-end/vendor/autoload.php";

$eventoServico = new EventoServico();
$resultados = $eventoServico->buscar($_POST["busca"] ?? '');
$quantidade = count($resultados);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Resultados da Busca</title>
</head>
<body>
    <main>
        <div class="resultados-container">
            <?php if($quantidade > 0): ?>
                <h2>Resultados: <span><?=$quantidade?></span></h2>
                <div class="resultados-lista">
                    <?php foreach($resultados as $itemEvento): ?>
                        <a href="index.php?id=<?=$itemEvento['id']?>" class="resultado-item">
                            <?=$itemEvento['nome']?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <h2>Sem eventos</h2>
                <p class="sem-resultados">Nenhum evento encontrado para sua busca.</p>
            <?php endif; ?>
        </div>
    </main>
    <?php include 'includes/nav.php'; ?>
</body>
</html>

    


