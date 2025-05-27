<?php
session_start();

use ProjetaBD\Auth\ControleDeAcesso;
use ProjetaBD\Services\EventoServico;
use ProjetaBD\Services\ProjetoServico;
use ProjetaBD\Services\UsuarioServico;
use ProjetaBD\Helpers\Utils;

require_once "../pi-back-end/vendor/autoload.php";

$usuarioServico = new UsuarioServico;
$projetoServico = new ProjetoServico();
$eventoServico = new EventoServico();

ControleDeAcesso::exigirLogin();

$id = $_SESSION['id'];
$qProjetos = $projetoServico->contarProjetos($id);
$projetos = $projetoServico->projetosPerfil($id);

$qEventos = $eventoServico->contarEventos($id);
$eventos = $eventoServico->eventosPerfil($id);

if (isset($_GET['confirmar-exclusao'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if ($id) {
        if ($tipo === 'evento') {
            $eventoServico->excluir($id);
        } elseif ($tipo === 'projeto') {
            $projetoServico->excluir($id);
        }
        header("location:perfil.php");
        exit;
    }
}

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
    <?php if (!empty($projetos) || !empty($eventos)): ?>
        <?php include 'includes/modal-confirmacao.php'; ?>
    <?php endif; ?>

    <?php if (isset($_GET['id']) && !isset($_GET['confirmar-exclusao'])): ?>
        <?php include 'includes/card-modal.php'; ?>
    <?php endif; ?>

    <main>
        <div class="perfil-container">
            <div class="perfil-header">
                <div class="perfil-img">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Foto do perfil">
                </div>
                <div class="perfil-info">
                    <h2><?= $_SESSION['nome'] ?></h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ipsum, odit quia corporis a cum.</p>
                    <div class="perfil-status">
                        <div class="status">
                            <span class="numero"><?= $qProjetos['total_projetos'] ?></span>
                            <span class="label">Projetos</span>
                        </div>
                        <div class="status">
                            <span class="numero"><?= $qEventos['total_eventos'] ?></span>
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
                <button id="meusProjetosBtn" class="perfil-botao">Projetos</button>
                <button id="projetosSeguidosBtn" class="perfil-botao" ">Eventos</button>
            </div>

            <div class="perfil-conteudo">
                <div id="meusProjetos" class="aba-conteudo ativo">
                    <div class="projetos">
                        <?php
                        foreach ($projetos as $projeto) {
                            $imagem = !empty($projeto["imagem"]) ? Utils::getCaminhoImagem($projeto["imagem"]) : null;
                        ?>
                            <div class="projeto-card">
                                <img src="<?= $imagem ?>" alt="">
                                <div class="projeto-info">
                                    <h3><?= $projeto['nome'] ?></h3>
                                    <div class="projeto-status">
                                        <a href="#" onclick="showDeleteModal(<?=$projeto['id']?>, 'projeto'); return false;"><button><i class="fa-solid fa-trash"></i> Excluir</button></a>
                                        <button><i class="fa-solid fa-pen"></i> Atualizar</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="projetosSeguidos" class="aba-conteudo">
                    <div class="projetos">
                        <?php
                        foreach ($eventos as $evento) {
                            $imagem = !empty($evento["imagem"]) ? Utils::getCaminhoImagem($evento["imagem"]) : null;
                        ?>
                            <div class="projeto-card">
                                <img src="<?= $imagem ?>" alt="">
                                <div class="projeto-info">
                                    <h3><?= $evento['nome'] ?></h3>
                                    <p><?= $evento['descricao'] ?></p>
                                    <div class="projeto-status">
                                        <a href="#" onclick="showDeleteModal(<?=$evento['id']?>, 'evento'); return false;"><button><i class="fa-solid fa-trash"></i> Excluir</button></a>
                                        <button><i class="fa-solid fa-pen"></i> Atualizar</button>
                                        <a href="?id=<?=$evento['id']?>" class="ver-mais"><button><i class="fa-solid fa-eye"></i> Ver mais</button></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/nav.php' ?>
    <script src="js/pages/perfil.js"></script>
    <?php if (isset($_GET['id']) && !isset($_GET['confirmar-exclusao'])): ?>
        <script src="js/pages/main.js"></script>
    <?php endif; ?>
</body>

</html>