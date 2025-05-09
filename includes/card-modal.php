<?php 
foreach($listarEventos as $evento) {
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
                <h2 class="post-modal-titulo"><?= $evento["nome"]?></h2>
                <div class="post-modal-meta">
                    <span><i class="far fa-calendar"></i><?=$evento["data"]?></span>
                    <span><i class="far fa-user"></i> <?=$evento["nome_usuario"]?></span>
                </div>
            </div>
        </div>

        <div class="post-modal-quebra">
            <div class="post-modal-main">
                <div class="post-modal-descricao">
                    <h3>Sobre o Evento</h3>
                    <?=$evento["descricao"]?>
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
                            <span><strong>Local:</strong> <?=$evento["bairro"]?>, <?=$evento["cidade"]?> <br> <?=$evento["RUA"]?>  <span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span><strong>Horário:</strong> 14:00</span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-calendar"></i>
                            <span><strong>Data:</strong> 15 de Março, 2024</span>
                        </div>
                    </div>

                    <div class="secao-info">
                        <h4 class="secao-titulo">
                            <i class="fas fa-user-friends"></i>
                            Organizadores
                        </h4>
                        <div class="info-item">
                            <i class="far fa-user"></i>
                            <span><strong>Responsável:</strong> <?=$evento["nome_usuario"]?></span>
                        </div>
                        <div class="info-item">
                            <i class="far fa-building"></i>
                            <span><strong>Organização:</strong><?=$evento["nome_projeto"]?></span>
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
<?php }?>