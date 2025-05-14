<?php
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$listarUm = $eventoServico->listarUm($id);
?>
<div id="postModal" class="post-modal">
    <div class="post-modal-conteudo">
        <span class="fechar-modal">&times;</span>
        <div class="post-modal-banner">
            <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                alt="Banner do evento">
        </div>

        <div class="post-modal-header">
            <div class="post-header-icon">
                <i class="far fa-user"></i>
            </div>
            <div class="post-header-info">
                <h2 class="post-modal-titulo"><?=$listarUm[0]["nome"]?></h2>
                <div class="post-modal-meta">
                    <span><i class="far fa-calendar"></i><?=$listarUm[0]["data"]?></span>
                    <span><i class="far fa-user"></i><?=$listarUm[0]["usuario_nome"]?></span>
                </div>
            </div>
        </div>

        <div class="post-modal-quebra">
            <div class="post-modal-main">
                <div class="post-modal-descricao">
                    <h3>Sobre o Evento</h3>
                    <p><?=$listarUm[0]["descricao"]?></p>
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
                            <span><strong>Local:</strong> <?=$listarUm[0]["RUA"]?>, <?=$listarUm[0]["numero"]?> - <?=$listarUm[0]["bairro"]?>. CEP: <?=$listarUm[0]["CEP"]?>. <?=$listarUm[0]["cidade"]?> - <?=$listarUm[0]["UF"]?></span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span><strong>Horário:</strong> 14:00</span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-calendar"></i>
                            <span><strong>Data:</strong><?=$listarUm[0]["data"]?></span>
                        </div>
                    </div>

                    <div class="secao-info">
                        <h4 class="secao-titulo">
                            <i class="fas fa-user-friends"></i>
                            Organizadores
                        </h4>
                        <div class="info-item">
                            <i class="far fa-user"></i>
                            <span><strong>Responsável:</strong> <?=$listarUm[0]["usuario_nome"]?></span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-building"></i>
                            <span><strong>Organização:</strong> <?=$listarUm[0]["projeto_nome"]?></span>
                        </div>
                    </div>


                    <div class="secao-info">
                        <h4 class="secao-titulo">
                            <i class="fas fa-tag"></i>
                            Detalhes
                        </h4>
                        <div class="info-item">
                            <i class="far fa-id-card"></i>
                            <span><strong>ID do Evento:</strong> #2024031501</span>
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
