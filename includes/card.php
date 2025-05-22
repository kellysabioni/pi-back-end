<?php
use ProjetaBD\Helpers\Utils;

foreach($listarEventos as $evento) {
    $imagem = !empty($evento["imagem"]) ? Utils::getCaminhoImagem($evento["imagem"]) : null;
?>
<div class="post" id="evento_<?= $evento["id"]?>" data-id="<?=$evento["id"]?>">
    <div class="post-card">
        <div class="card-header">
            <div class="card-icon">
                <i class="far fa-user"></i>
            </div>
            <div class="card-header-info">
                <h3 class="card-titulo"><?=$evento["nome"]?></h3>
                <span class="card-data"><?=$evento["data"]?></span>
            </div>
        </div>
        <?php if ($imagem): ?>
        <div class="post-modal-banner">
            <img src="<?= $imagem ?>" alt="Banner do evento">
        </div>
        <?php endif; ?>
        <div class="card-main">
            <p class="card-conteudo">
                <strong>📍 Local:</strong> <?=$evento["rua"]?><br>
                <strong>🕒 Horário:</strong> <?=$evento["hora"]?><br>
                <strong>👥 Organizador:</strong> <?=$evento["usuario_nome"]?><?=$evento["projeto_nome"]?><br><br>
                <?=$evento["descricao"]?>
            </p>
        </div>
        <div class="card-footer">
            <div class="card-acoes">
                <span class="card-acao">
                    <i class="far fa-calendar-plus"></i>
                    <span>Participar</span>
                </span>
                <span class="card-acao">
                    <i class="far fa-share-square"></i>
                    <span>Compartilhar</span>
                </span>
            </div>
        </div>
    </div>
</div>
<?php }?>