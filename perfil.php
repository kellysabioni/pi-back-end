<?php
session_start();

use ProjetaBD\Services\EventoServico;
use ProjetaBD\Services\ProjetoServico;
use ProjetaBD\Services\UsuarioServico;
require_once "../pi-back-end/vendor/autoload.php";

$usuarioServico = new UsuarioServico;
$projetoServico = new ProjetoServico();
$eventoServico = new EventoServico();

$id = $_SESSION['id'];
$eventos = $eventoServico->eventosPerfil($id);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>perfil</title>
</head>

<body>
    <main>
        <div class="perfil-container">
            <div class="perfil-header">
                <div class="perfil-img">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Foto do perfil">
                </div>
                <div class="perfil-info">
                    <h2><?=$_SESSION['nome']?></h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ipsum, odit quia corporis a cum.</p>
                    <div class="perfil-status">
                        <div class="status">
                            <span class="numero">12</span>
                            <span class="label">Projetos</span>
                        </div>
                        <div class="status">
                            <span class="numero"><?=$eventos['total_eventos']?></span>
                            <span class="label">Eventos</span>
                        </div>
                        <div class="status">
                            <span class="numero">3</span>
                            <span class="label">Seguindo</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="perfil-botoes">
                <button id="meusProjetosBtn" class="perfil-botao">Meus Projetos</button>
                <button id="projetosSeguidosBtn" class="perfil-botao"  style="display: none;">Projetos Seguidos</button>
                <button id="projetosCriadosBtn" class="perfil-botao" style="display: none;">Projetos Criados</button>
            </div>

            <div class="perfil-conteudo">
                <div id="meusProjetos" class="aba-conteudo ativo">
                    <div class="projetos">
                        <div class="projeto-card">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Projeto Verde Vida">
                            <div class="projeto-info">
                                <h3>meusProjetos</h3>
                                <p>Iniciativa de reflorestamento urbano e conscientização ambiental.</p>
                                <div class="projeto-status">
                                    <span><i class="fas fa-users"></i> 45 participantes</span>
                                    <span><i class="fas fa-calendar"></i> Em andamento</span>
                                </div>
                            </div>
                        </div>
                        <div class="projeto-card">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Projeto Verde Vida">
                            <div class="projeto-info">
                                <h3>meusProjetos</h3>
                                <p>Iniciativa de reflorestamento urbano e conscientização ambiental.</p>
                                <div class="projeto-status">
                                    <span><i class="fas fa-users"></i> 45 participantes</span>
                                    <span><i class="fas fa-calendar"></i> Em andamento</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="projetosSeguidos" class="aba-conteudo">
                    <div class="projetos">
                        <div class="projeto-card">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Projeto Verde Vida">
                            <div class="projeto-info">
                                <h3>projetosSeguidos</h3>
                                <p>Iniciativa de reflorestamento urbano e conscientização ambiental.</p>
                                <div class="projeto-status">
                                    <span><i class="fas fa-users"></i> 45 participantes</span>
                                    <span><i class="fas fa-calendar"></i> Em andamento</span>
                                </div>
                            </div>
                        </div>
                        <div class="projeto-card">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Projeto Verde Vida">
                            <div class="projeto-info">
                                <h3>projetosSeguidos</h3>
                                <p>Iniciativa de reflorestamento urbano e conscientização ambiental.</p>
                                <div class="projeto-status">
                                    <span><i class="fas fa-users"></i> 45 participantes</span>
                                    <span><i class="fas fa-calendar"></i> Em andamento</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="projetosCriados" class="aba-conteudo">
                    <div class="projetos">
                        <div class="projeto-card">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Projeto Verde Vida">
                            <div class="projeto-info">
                                <h3>projetosCriados</h3>
                                <p>Iniciativa de reflorestamento urbano e conscientização ambiental.</p>
                                <div class="projeto-status">
                                    <span><i class="fas fa-users"></i> 45 participantes</span>
                                    <span><i class="fas fa-calendar"></i> Em andamento</span>
                                </div>
                            </div>
                        </div>
                        <div class="projeto-card">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Projeto Verde Vida">
                            <div class="projeto-info">
                                <h3>projetosCriados</h3>
                                <p>Iniciativa de reflorestamento urbano e conscientização ambiental.</p>
                                <div class="projeto-status">
                                    <span><i class="fas fa-users"></i> 45 participantes</span>
                                    <span><i class="fas fa-calendar"></i> Em andamento</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'includes/nav.php' ?>
    <script src="js/pages/perfil.js"></script>
</body>

</html>