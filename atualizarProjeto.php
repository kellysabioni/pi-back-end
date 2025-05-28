<?php
session_start();

use ProjetaBD\Enums\Categoria;
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Models\Projeto;
use ProjetaBD\Services\ProjetoServico;
use ProjetaBD\Services\FotoServico;
use ProjetaBD\Auth\ControleDeAcesso;
use ProjetaBD\Helpers\Validacoes;

require_once __DIR__ . "/vendor/autoload.php";

ControleDeAcesso::exigirLogin();

$projetoServico = new ProjetoServico();

// Get project ID from URL
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$projeto = $projetoServico->listarUm($id)[0];

if (isset($_POST['atualizar'])) {
    try {
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $CEP = filter_input(INPUT_POST, "CEP", FILTER_SANITIZE_SPECIAL_CHARS);
        $rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
        $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);
        $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
        $UF = filter_input(INPUT_POST, "UF", FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = Categoria::from(filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_SPECIAL_CHARS));
        
        // Validações
        Validacoes::validarNome($nome);
        Validacoes::validarCEP($CEP);
        Validacoes::validarEndereco($rua);
        Validacoes::validarNumero($numero);
        Validacoes::validarBairro($bairro);
        Validacoes::validarCidade($cidade);
        Validacoes::validarUF($UF);
        Validacoes::validarTelefone($telefone);
        Validacoes::validarCategoria($categoria->value);

        $projetoAtualizado = new Projeto(
            $nome,
            $CEP,
            $rua,
            $numero,
            $bairro,
            $cidade,
            $UF,
            $telefone,
            $categoria,
            $projeto['created_at'],
            date('Y-m-d H:i:s'),
            $projeto['usuarios_id'],
            $id
        );
        
        $projetoServico->atualizar($projetoAtualizado);

        // Se houver nova imagem, faz o upload e atualiza
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $nomeDaImagem = Utils::upload($_FILES['imagem']);
            if ($nomeDaImagem) {
                $fotoServico = new FotoServico();
                $fotoServico->atualizar($nomeDaImagem, $projeto['usuarios_id'], null, $id);
            }
        }

        header("location: perfil.php");
        exit;
    } catch (InvalidArgumentException $e) {
        $mensagemErro = $e->getMessage();
    } catch (Throwable $e) {
        $mensagemErro = "Erro ao atualizar projeto: " . $e->getMessage();
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
    <title>Atualizar Projeto</title>
</head>
<body>
    <main>
        <div class="formularios" id="formProjeto">
            <h2>Atualizar Projeto</h2>

            <?php if (isset($mensagemErro)): ?>
                <div class="mensagem-erro">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $mensagemErro ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form">
                    <label for="nomeProjeto">Nome do Projeto <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="nomeProjeto" name="nome" value="<?= $projeto['nome'] ?>" required>
                </div>

                <div class="form">
                    <label for="categoriaProjeto">Categoria <span class="campo-obrigatorio">*</span></label>
                    <select name="categoria" id="categoriaProjeto">
                        <?php foreach (Categoria::cases() as $categoria): ?>
                            <option value="<?= $categoria->value ?>" <?= $projeto['categoria'] === $categoria->value ? 'selected' : '' ?>>
                                <?= $categoria->value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form">
                    <label for="cep">CEP <span class="campo-obrigatorio">*</span></label>
                    <div class="cep">
                        <input type="text" name="CEP" id="cep" value="<?= $projeto['CEP'] ?>" required>
                        <button type="button" id="buscarBtn" class="btnCEP">buscar</button>
                    </div>
                    <div id="resultado"></div>
                </div>

                <div class="form formCep">
                    <label for="rua">Rua <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="rua" name="rua" value="<?= $projeto['rua'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="complemento">Número <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="complemento" name="numero" value="<?= $projeto['numero'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="bairro">Bairro <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="bairro" name="bairro" value="<?= $projeto['bairro'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="cidade">Cidade <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="cidade" name="cidade" value="<?= $projeto['cidade'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="estado">Estado <span class="campo-obrigatorio">*</span></label>
                    <input type="text" id="estado" name="UF" value="<?= $projeto['UF'] ?>" required>
                </div>

                <div class="form">
                    <label for="celular">Telefone <span class="campo-obrigatorio">*</span></label>
                    <input type="tel" id="celular" name="telefone" value="<?= $projeto['telefone'] ?>" required>
                </div>

                <div class="form">
                    <label for="imagemProjeto">Nova Imagem do Projeto (opcional)</label>
                    <input type="file" id="imagemProjeto" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
                </div>

                <div class="form">
                    <button name="atualizar" type="submit" class="btnEnviar">Atualizar</button>
                    <a href="perfil.php" class="btnCancelar">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <?php include 'includes/nav.php' ?>
    <script src="https://unpkg.com/imask"></script>
    <script type="module" src="js/pages/criar.js"></script>
    <script src="js/pages/main.js"></script>
</body>
</html> 