<?php

use ProjetaBD\Enums\Categoria;
use ProjetaBD\Models\Projeto;
use ProjetaBD\Services\ProjetoServico;

require_once "../pi-back-end/vendor/autoload.php";

$projetoServico = new ProjetoServico;

if (isset($_POST['enviar'])) {
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $CEP = filter_input(INPUT_POST, "CEP", FILTER_SANITIZE_SPECIAL_CHARS);
    $rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
    $UF = filter_input(INPUT_POST, "UF", FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
    $categoriaStr = filter_input(INPUT_POST, "categoriaProjeto", FILTER_SANITIZE_SPECIAL_CHARS);
    $usuarios_id = filter_input(INPUT_POST, "usuarios_id", FILTER_SANITIZE_SPECIAL_CHARS);
    $projetos_id = filter_input(INPUT_POST, "projetos_id", FILTER_SANITIZE_SPECIAL_CHARS);

    try {
        $categoria = Categoria::from($categoriaStr);
    } catch (ValueError $e) {
        die("Categoria inválida.");
    }

    $projeto = new Projeto($nome, $CEP, $rua, $numero, $bairro, $cidade, $UF, $telefone, $categoria, "", "",1,null);
    $projetoServico->inserir($projeto);

    header("location:index.php");
    exit;
}
?>

<div class="formularios" id="formProjeto">
    <h2>Criar Novo Projeto</h2>

    <form action="" method="">
        <div class="form">
            <label for="nomeProjeto">Nome do Projeto</label>
            <input type="text" id="nomeProjeto" name="nome" placeholder="Digite o nome do Projeto" required>
        </div>

        <div class="form">
            <label for="categoriaProjeto">Categoria</label>
            <select name="categoriaProjeto" id="categoriaProjeto">
                <?php foreach (\ProjetaBD\Enums\Categoria::cases() as $categoria): ?>
                    <option value="<?=$categoria->value?>">
                        <?= $categoria->value ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form">
            <label for="cep">CEP</label>
            <div class="cep">
                <input type="text" name="CEP" id="cep" maxlength="9" placeholder="00000-000" required>
                <button type="button" id="buscarBtn" class="btnCEP">buscar</button>
            </div>
            <div id="resultado"></div>
        </div>

        <div class="form formCep">
            <label for="rua">Rua</label>
            <input type="text" id="rua" name="rua" required>
        </div>

        <div class="form formCep">
            <label for="complemento">complemento</label>
            <input type="text" id="complemento" name="numero">
        </div>

        <div class="form formCep">
            <label for="bairro">Bairro</label>
            <input type="text" id="bairro" name="bairro" required>
        </div>

        <div class="form formCep">
            <label for="cidade">Cidade</label>
            <input type="text" id="cidade" name="cidade" required>
        </div>

        <div class="form formCep">
            <label for="estado">Estado</label>
            <input type="text" id="estado" name="UF" required>
        </div>

        <div class="form">
            <label for="celulaProjeto">Telefone</label>
            <input type="text" id="celular" name="telefone" maxlength="15" placeholder="(00) 00000-0000" required>
        </div>

        <div class="form">
            <label for="imagemProjeto">Imagem do Projeto</label>
            <input type="file" id="imagemProjeto" name="imagemProjeto" accept="image/*">
        </div>

        <div class="form">
            <button name="enviar" type="submit" class="btnEnviar">Enviar</button>
        </div>
    </form>
</div>