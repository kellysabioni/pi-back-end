<?php
session_start();

use ProjetaBD\Auth\ControleDeAcesso;
use ProjetaBD\Services\EventoServico;
use ProjetaBD\Services\ProjetoServico;
use ProjetaBD\Services\UsuarioServico;
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Services\FotoServico;

require_once "vendor/autoload.php";

ControleDeAcesso::exigirLogin();

$fotoServico = new FotoServico();
$usuarioServico = new UsuarioServico();
$projetoServico = new ProjetoServico();
$eventoServico = new EventoServico();

$idUsuario = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_NUMBER_INT);
$idEvento = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$idUsuario) {
    header("location:index.php");
    exit;
}

// Buscar informações do usuário
$usuario = $usuarioServico->buscarPorId($idUsuario);
$fotoUser = $fotoServico->buscarPorUsuario($idUsuario);

$qProjetos = $projetoServico->contarProjetos($idUsuario);
$projetos = $projetoServico->projetosPerfil($idUsuario);

$qEventos = $eventoServico->contarEventos($idUsuario);
$eventos = $eventoServico->eventosPerfil($idUsuario);

if (isset($_GET['confirmar-exclusao'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if ($id) {
        if ($tipo === 'evento') {
            $eventoServico->excluir($id);
        } elseif ($tipo === 'projeto') {
            $projetoServico->excluir($id);
        }
        header("location:visita-perfil.php?user=" . $idUsuario);
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
    <main>
        <div class="perfil-container">
            <div class="perfil-header">
                <div class="perfil-img">
                    <?php if (!empty($fotoUser)): ?>
                        <?php
                        $caminhoImagem = Utils::getCaminhoImagem($fotoUser['nome_arquivo']);
                        error_log("Caminho da imagem: " . $caminhoImagem);
                        ?>
                        <img src="<?= $caminhoImagem ?>" alt="Foto de perfil de <?= $_SESSION['nome'] ?>">
                    <?php else: ?>
                        <i class="fa-regular fa-user"></i>
                    <?php endif; ?>
                </div>
                <div class="perfil-info">
                    <h2><?= $usuario['nome'] ?></h2>
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
                    </div>
                </div>
            </div>
            
            <div class="perfil-botoes">
                <button id="meusProjetosBtn" class="perfil-botao">Projetos</button>
                <button id="projetosSeguidosBtn" class="perfil-botao" ">Eventos</button>
            </div>
            
            <div class=" perfil-conteudo">
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
                                                <a href="?user=<?=$idUsuario?>&id=<?=$evento['id']?>" class="ver-mais">
                                                    <button><i class="fa-solid fa-eye"></i> Ver mais</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
            </div>
        </div>
    </main>
    
    <?php include 'includes/card-modal.php'; ?>
    <?php include 'includes/nav.php' ?>
    <script src="js/pages/perfil.js"></script>
    <script src="js/pages/perfil.js"></script>
    <script src="js/pages/main.js"></script>
    </body>
    
    </html>