<?php

use ProjetaBD\Helpers\Utils;
use ProjetaBD\Services\FotoServico;

foreach ($listarEventos as $evento) {
    $imagem = !empty($evento["imagem"]) ? Utils::getCaminhoImagem($evento["imagem"]) : null;
    
    // Get user photo
    $fotoServico = new FotoServico();
    $fotoUser = $fotoServico->buscarPorUsuario($evento["usuario_id"]);
    $caminhoImagem = !empty($fotoUser['nome_arquivo']) ? Utils::getCaminhoImagem($fotoUser['nome_arquivo']) : null;
?>
    <div class="post" id="evento_<?= $evento["id"] ?>" data-id="<?= $evento["id"] ?>">
        <div class="post-card">
            <div class="card-header">
                <div class="card-icon">
                    <?php if ($caminhoImagem): ?>
                        <img src="<?= $caminhoImagem ?>" alt="Foto de perfil de <?= $evento["usuario_nome"] ?>" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; object-position: center;">
                    <?php else: ?>
                        <i class="fa-regular fa-user" style="font-size: 24px;"></i>
                    <?php endif; ?>
                </div>
                <div class="card-header-info">
                    <h3 class="card-titulo"><?= $evento["nome"] ?></h3>
                 <!--    <span class="card-data"><?= $evento["data"] ?></span> -->
                </div>
            </div>
            <?php if ($imagem): ?>
                <div class="post-modal-banner">
                    <img src="<?= $imagem ?>" alt="Banner do evento">
                </div>
            <?php endif; ?>
            <div class="card-main">
                <p class="card-conteudo">
                    <strong>📍 Local:</strong> <?= $evento["rua"] ?><br>
                    <strong>🗓️ Data:</strong> <?= date('d/m/Y', strtotime($evento["data"])) ?><br>
                    <strong>🕒 Horário:</strong> <?= date('H:i', strtotime($evento["hora"])) ?><br>
                    <strong>👥 Organizador:</strong> <?= $evento["usuario_nome"] ?><br>
                    <strong>🏢 Organização: </strong> <?= $evento["projeto_nome"] ?><br><br>
                    <?= $evento["descricao"] ?>
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
<?php 
} ?>