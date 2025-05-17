<?php
foreach($listarEventos as $evento) {
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
                    <div class="post-modal-banner">
                        <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                            alt="Banner do evento">
                    </div>
                    <div class="card-main">
                        <p class="card-conteudo">
                            <strong>📍 Local:</strong> <?=$evento["rua"]?><br>
                            <strong>🕒 Horário:</strong> 14:00<br>
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