<?php

use ProjetaBD\Enums\Categoria;
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Helpers\Validacoes;
use ProjetaBD\Models\Projeto;
use ProjetaBD\Services\ProjetoServico;
use ProjetaBD\Services\FotoServico;

require_once "../vendor/autoload.php";

$projetoServico = new ProjetoServico();
$fotoServico = new FotoServico();

if (isset($_POST['enviar'])) {
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
        $usuarios_id = $_SESSION['id']; 

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

        $projeto = new Projeto(
            $nome, $CEP, $rua, $numero, $bairro, $cidade, $UF, $telefone, $categoria, 
            date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $usuarios_id
        );

        $projetoServico->inserir($projeto);

        $projetoId = $projetoServico->getConexao()->lastInsertId();
        
        // Se houver imagem, faz o upload e salva na tabela fotos
        if (isset($_FILES['imagem'])) {
            error_log("Arquivo recebido: " . print_r($_FILES['imagem'], true));
            
            if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $nomeDaImagem = Utils::upload($_FILES['imagem']);
                error_log("Nome da imagem após upload: " . $nomeDaImagem);
                
                if ($nomeDaImagem) {
                    $fotoServico->inserir($nomeDaImagem, $usuarios_id, null, $projetoId);
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
    } catch (Throwable $e) {
        $mensagemErro = "Erro ao criar projeto: " . $e->getMessage();
    }
}
?>

<div class="formularios" id="formProjeto">
    <h2>Criar Novo Projeto</h2>

    <?php if (isset($mensagemErro)): ?>
        <div class="mensagem-erro">
            <i class="fas fa-exclamation-circle"></i>
            <?= $mensagemErro ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form">
            <label for="nomeProjeto">Nome do Projeto <span class="campo-obrigatorio">*</span></label>
            <input type="text" id="nomeProjeto" name="nome" placeholder="Digite o nome do Projeto" required>
        </div>

        <div class="form">
            <label for="categoriaProjeto">Categoria <span class="campo-obrigatorio">*</span></label>
            <select name="categoria" id="categoriaProjeto">
                <?php foreach (\ProjetaBD\Enums\Categoria::cases() as $categoria): ?>
                    <option value="<?=$categoria->value?>">
                        <?= $categoria->value ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form">
            <label for="cep">CEP <span class="campo-obrigatorio">*</span></label>
            <div class="cep">
                <input type="text" name="CEP" id="cep" maxlength="9" placeholder="00000-000" required>
                <button type="button" id="buscarBtn" class="btnCEP">buscar</button>
            </div>
            <div id="resultado"></div>
        </div>

        <div class="form formCep">
            <label for="rua">Rua <span class="campo-obrigatorio">*</span></label>
            <input type="text" id="rua" name="rua" required>
        </div>

        <div class="form formCep">
            <label for="complemento">Numero <span class="campo-obrigatorio">*</span></label>
            <input type="text" id="complemento" name="numero" required>
        </div>

        <div class="form formCep">
            <label for="bairro">Bairro <span class="campo-obrigatorio">*</span></label>
            <input type="text" id="bairro" name="bairro" required>
        </div>

        <div class="form formCep">
            <label for="cidade">Cidade <span class="campo-obrigatorio">*</span></label>
            <input type="text" id="cidade" name="cidade" required>
        </div>

        <div class="form formCep">
            <label for="estado">Estado <span class="campo-obrigatorio">*</span></label>
            <input type="text" id="estado" name="UF" required>
        </div>

        <div class="form">
            <label for="celular">Telefone <span class="campo-obrigatorio">*</span></label>
            <input type="text" id="celular" name="telefone" maxlength="15" placeholder="(00) 00000-0000" required>
        </div>

        <div class="form">
            <label for="imagemProjeto">Imagem do Projeto <span class="campo-obrigatorio">*</span></label>
            <input type="file" id="imagemProjeto" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml" required>
        </div>

        <div class="form">
            <button name="enviar" type="submit" class="btnEnviar">Enviar</button>
        </div>
    </form>
</div>