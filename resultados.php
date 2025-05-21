<?php
/* Este arquivo é usado em conjunto com o js/busca.js */

use ProjetaBD\Services\EventoServico;

require_once "../pi-back-end/vendor/autoload.php";

$eventoServico = new EventoServico();
$resultados = $eventoServico->buscar($_POST["busca"] ?? '');
$quantidade = count($resultados);

if($quantidade > 0){
?>
    <h2>Resultados: <span><?=$quantidade?></span></h2>
    <div>
        <?php foreach($resultados as $itemEvento){ ?>
        <a
        href="index.php?id=<?=$itemEvento['id']?>">
            <?=$itemEvento['nome']?>
        </a>
        <?php } ?>
    </div>
<?php } else { ?>
    <h2>Sem eventos</h2>
<?php } ?>

    


