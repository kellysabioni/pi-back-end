<?php

use ProjetaBD\Auth\ControleDeAcesso;
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Models\Usuario;
use ProjetaBD\Services\FotoServico;
use ProjetaBD\Services\UsuarioServico;

require_once "../pi-back-end/vendor/autoload.php";

ControleDeAcesso::exigirLogin();
$usuarioServico = new UsuarioServico();
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$usuario = $usuarioServico->buscarPorId($id);

if (isset($_POST['atualizar'])) {
    try {
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $senhaBruta = $_POST["senha"];
        $senha = empty($senhaBruta) ? $usuario["senha"] : Utils::verificarSenha($senhaBruta, $usuario["senha"]);

        $usuarioAtualizado = new Usuario(
            $nome,
            $email,
            $senha,
            $usuario['tipo_usuario'],
            $id,
            $usuario['cpf'],
            $usuario['data_nascimento'],
            $usuario['created_at'],
            date('Y-m-d H:i:s')
        );

        $usuarioServico->atualizar($usuarioAtualizado);

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $nomeDaImagem = Utils::upload($_FILES['imagem']);
            if ($nomeDaImagem) {
                $fotoServico = new FotoServico();
                $fotoServico->atualizar($nomeDaImagem, $usuario['usuarios_id'], null, null);
            }
        }

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        header("location: perfil.php");
        exit;
    } catch (InvalidArgumentException $e) {
        $mensagemErro = $e->getMessage();
    } catch (Throwable $e) {
        $mensagemErro = "Erro ao atualizar usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Atualizar Perfil</title>
</head>

<body>
    <main>
        <div class="formularios" id="formCadastro">
            <h2>Atualizar</h2>

            <?php if (isset($mensagemErro)): ?>
                <div class="mensagem-erro">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $mensagemErro ?>
                </div>
            <?php endif; ?>


            <form id="cadastroForm" method="POST" action="" enctype="multipart/form-data">
                <div class="form" style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                    <div class="foto" style="width: 120px; height: 120px; border-radius: 50%; background: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <?php if ($caminhoImagem) : ?>
                        <i class="fa-regular fa-user" style="font-size: 48px; color: #666;"></i>
                        <img id="previewImagem" src="<?= $caminhoImagem?>" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                        <?php else : ?>
                        <img id="previewImagem" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                        <i class="fa-regular fa-user" style="font-size: 48px; color: #666;"></i>
                        <?php endif; ?>

                    </div>
                    <div style="text-align: center;">
                        <label for="imagemPerfil" style="display: block; margin-bottom: 5px; font-weight: bold;">Nova foto de Perfil </label>
                        <input type="file" id="imagemPerfil" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml"  style="width: 100%;">
                        <small style="display: block; margin-top: 5px; color: #666;">Formatos aceitos: JPG, PNG, GIF e SVG (máx. 2MB)</small>
                    </div>
                </div>

                <div class="form">
                    <label for="nome">Nome </label>
                    <input type="text" id="nome" name="nome" value="<?= $usuario['nome'] ?>">
                </div>
                <div class="form">
                    <label for="email">Email </label>
                    <input type="email" id="email" name="email" value="<?= $usuario['email'] ?>">
                </div>
                <div class="form">
                    <label for="senha">Senha </label>
                    <input type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
                </div>
                <div class="form">
                    <button name="atualizar" type="submit" class="btnEnviar">Atualizar</button>
                    <a href="perfil.php" class="btnCancelar">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
    <?php include 'includes/nav.php'; ?>
    
    <script>
    document.getElementById('imagemPerfil').onchange = function(e) {
        const preview = document.getElementById('previewImagem');
        const icon = document.querySelector('.fa-user');
        const file = e.target.files[0];
        
        if (file) {
            // Verifica o tamanho do arquivo (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('O arquivo é muito grande. Tamanho máximo permitido: 2MB');
                this.value = ''; // Limpa o input
                return;
            }

            // Verifica o tipo do arquivo
            const tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
            if (!tiposPermitidos.includes(file.type)) {
                alert('Formato de arquivo não permitido. Use apenas JPG, PNG, GIF ou SVG.');
                this.value = ''; // Limpa o input
                return;
            }

            preview.style.display = 'block';
            icon.style.display = 'none';
            preview.src = URL.createObjectURL(file);
        } else {
            preview.style.display = 'none';
            icon.style.display = 'block';
        }
    };
    </script>
</body>

</html>