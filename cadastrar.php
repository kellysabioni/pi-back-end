<?php
require_once "../pi-back-end/vendor/autoload.php";

use ProjetaBD\Services\UsuarioServico as ServicesUsuarioServico;
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Helpers\Validacoes;
use ProjetaBD\Models\Usuario;
use ProjetaBD\Services\FotoServico;
use ProjetaBD\Services\UsuarioServico;

$usuarioServico = new ServicesUsuarioServico();
$fotoServico = new FotoServico();

if (isset($_POST['enviar'])) {
    try {
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validações
        Validacoes::validarNome($nome);
        Validacoes::validarEmail($email);
        Validacoes::validarSenha($senha);

        $usuario = new Usuario($nome, $email, $senha);

        $usuarioServico->inserir($usuario);

        $usuarioId = $usuarioServico->getConexao()->lastInsertId();

        if (isset($_FILES['imagem'])) {
            error_log("Arquivo recebido: " . print_r($_FILES['imagem'], true));
            
            if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $nomeDaImagem = Utils::upload($_FILES['imagem']);
                error_log("Nome da imagem após upload: " . $nomeDaImagem);
                
                if ($nomeDaImagem) {
                    $fotoServico->inserir($nomeDaImagem, $usuarioId, null, null);
                    error_log("Foto inserida no banco com sucesso");
                }
            } else {
                error_log("Erro no upload: " . $_FILES['imagem']['error']);
            }

        } else {
            error_log("Nenhum arquivo foi enviado");
        }

        header("location:index.php");
        exit;

    } catch (InvalidArgumentException $e) {
        $mensagemErro = $e->getMessage();
    } catch (Exception $e) {
        $mensagemErro = "Erro ao cadastrar: " . $e->getMessage();
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
    <title>Cadastrar</title>
</head>

<body>
    <main>
        <div class="formularios" id="formCadastro">
            <h2>Cadastrar</h2>

            <?php if (isset($mensagemErro)): ?>
                <div class="mensagem-erro">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $mensagemErro ?>
                </div>
            <?php endif; ?>

            <form id="cadastroForm" method="POST" action="" enctype="multipart/form-data">
                <div class="form" style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                    <div class="foto" style="width: 120px; height: 120px; border-radius: 50%; background: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <i class="fa-regular fa-user" style="font-size: 48px; color: #666;"></i>
                        <img id="previewImagem" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="text-align: center;">
                        <label for="imagemPerfil" style="display: block; margin-bottom: 5px; font-weight: bold;">Foto de Perfil <span class="campo-obrigatorio">*</span></label>
                        <input type="file" id="imagemPerfil" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml" required style="width: 100%;">
                        <small style="display: block; margin-top: 5px; color: #666;">Formatos aceitos: JPG, PNG, GIF e SVG (máx. 2MB)</small>
                    </div>
                </div>

                <div class="form">
                    <label for="nome">Nome <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form">
                    <label for="email">Email <span class="campo-obrigatorio">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form">
                    <label for="senha">Senha <span class="campo-obrigatorio">*</span></label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="form">
                    <button name="enviar" type="submit" class="btnEnviar">Cadastrar</button>
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