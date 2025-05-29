<?php
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Services\FotoServico;

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$listarUm = $eventoServico->listarUm($id);

// Verifica se o evento existe
if (!empty($listarUm) && isset($listarUm[0])) {
    $evento = $listarUm[0];
    $imagem = !empty($evento["imagem"]) ? Utils::getCaminhoImagem($evento["imagem"]) : null;

    $fotoServico = new FotoServico();
    $fotoUser = $fotoServico->buscarPorUsuario($evento["usuario_id"]);
    $caminhoImagem = !empty($fotoUser['nome_arquivo']) ? Utils::getCaminhoImagem($fotoUser['nome_arquivo']) : null;
?>
<div id="postModal" class="post-modal">
    <div class="post-modal-conteudo">
        <span class="fechar-modal">&times;</span>
        <?php if ($imagem): ?>
        <div class="post-modal-banner">
            <img src="<?= $imagem ?>" alt="Banner do evento">
        </div>
        <?php endif; ?>

        <div class="post-modal-header">
            <?php if ($caminhoImagem): ?>
                <img src="<?= $caminhoImagem ?>" alt="Foto de perfil de <?= $evento["usuario_nome"] ?>" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; object-position: center;">
            <?php else: ?>
                <i class="fa-regular fa-user"></i>
            <?php endif; ?>
            <div class="post-header-info">
                <h2 class="post-modal-titulo"><?=$evento["nome"]?></h2>
                <div class="post-modal-meta">
                    <span><i class="far fa-calendar"></i> <?=$evento["data"]?></span>
                    <span><i class="far fa-user"></i> <?=$evento["usuario_nome"]?></span>
                </div>
            </div>
        </div>

        <div class="post-modal-quebra">
            <div class="post-modal-main">
                <div class="post-modal-descricao">
                    <h3>Sobre o Evento</h3>
                    <p><?=$evento["descricao"]?></p>
                </div>
            </div>

            <div class="post-modal-lateral">
                <div class="post-modal-info">
                    <div class="secao-info">
                        <h4 class="secao-titulo">
                            <i class="fas fa-info-circle"></i>
                            Informações do Evento
                        </h4>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><strong>Local:</strong> <?=$evento["rua"]?>, <?=$evento["numero"]?> - <?=$evento["bairro"]?>. CEP: <?=$evento["CEP"]?>. <?=$evento["cidade"]?> - <?=$evento["UF"]?></span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span><strong>Horário:</strong> <?=$evento["hora"]?></span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-calendar"></i>
                            <span><strong>Data:</strong> <?=$evento["data"]?></span>
                        </div>
                    </div>

                    <div class="secao-info">
                        <h4 class="secao-titulo">
                            <i class="fas fa-user-friends"></i>
                            Organizadores
                        </h4>
                        <div class="info-item">
                            <i class="far fa-user"></i>
                            <span><strong>Responsável:</strong> <?=$evento["usuario_nome"]?></span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-building"></i>
                            <span><strong>Organização:</strong> <?=$evento["projeto_nome"]?></span>
                        </div>
                    </div>

                    <div class="secao-info">
                        <h4 class="secao-titulo">
                            <i class="fas fa-tag"></i>
                            Detalhes
                        </h4>
                        <div class="info-item">
                            <i class="far fa-id-card"></i>
                            <span><strong>ID do Evento:</strong> #<?=$evento["id"]?></span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <span><strong>Vagas:</strong> Ilimitadas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="post-modal-acoes">
            <button class="acoes-botao primeiro">
                <i class="far fa-calendar-plus"></i>
                Participar do Evento
            </button>
            <button class="acoes-botao segundo">
                <i class="far fa-share-square"></i>
                Compartilhar
            </button>
        </div>
    </div>
</div>
<?php } else { ?>
    <div id="postModal" class="post-modal">
        <div class="post-modal-conteudo">
            <span class="fechar-modal">&times;</span>
            <div class="post-modal-header">
                <h2 class="post-modal-titulo">Evento não encontrado</h2>
            </div>
        </div>
    </div>
<?php } ?>
