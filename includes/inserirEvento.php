<?php

use ProjetaBD\Enums\Categoria;
use ProjetaBD\Models\Evento;
use ProjetaBD\Services\EventoServico;

require_once "../pi-back-end/vendor/autoload.php";

$eventoServico = new EventoServico();

if( isset($_POST['enviar']) ){
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);
    $data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
    $CEP = filter_input(INPUT_POST, "CEP", FILTER_SANITIZE_SPECIAL_CHARS);
    $rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
    $UF = filter_input(INPUT_POST, "UF", FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = filter_input(INPUT_POST, "categoriaEvento", FILTER_SANITIZE_SPECIAL_CHARS);
    $usuarios_id = filter_input(INPUT_POST, "usuarios_id", FILTER_SANITIZE_SPECIAL_CHARS);
    $projetos_id = filter_input(INPUT_POST,"projetos_id", FILTER_SANITIZE_SPECIAL_CHARS);


    $evento = new Evento(null, $nome, $descricao, $data, $CEP, $rua, $numero, $bairro, $cidade, $UF, $telefone, Categoria::Indefinido, null,  1);
    $eventoServico->inserir($evento);

    header("location:index.php");
    exit;
}
?>

<div class="formularios" id="formEvento">
    <h2>Criar Novo Evento</h2>

    <form action="" method="post">
        <div class="form">
            <label for="nomeEvento">Nome do Evento</label>
            <input type="text" id="nomeEvento" name="nome" placeholder="Digite o nome do Evento" required>
        </div>

        <div class="form">
            <label for="categoriaEvento">Categoria</label>
            <select name="categoriaEvento" id="categoriaEvento">
                <?php foreach (\ProjetaBD\Enums\Categoria::cases() as $categoria): ?>
                    <option value="<?= $categoria->name ?>">
                        <?= $categoria->value ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="form">
            <label for="descricaoEvento">Descrição</label>
            <textarea name="descricao" id="descricaoEvento" placeholder="Descreva o Evento" required></textarea>
        </div>


        <div class="form">
            <label for="dataEvento">Data</label>
            <input type="date" name="data" id="dataEvento" required>
        </div>

        <div class="form">
            <label for="horarioEvento">Horario</label>
            <input type="time" name="horario" id="horarioEvento">
        </div>

        <div class="form">
            <label for="cep">CEP</label>
            <div class="cep">
                <input type="text" name="CEP" id="cep" placeholder="00000-000" required>
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
            <label for="celularEvento">Telefone</label>
            <input type="tel" id="celular" name="telefone" required placeholder="(00) 00000-0000">
        </div>

        <div class="form">
            <label for="imagemEvento">Imagem do Evento</label>
            <input type="file" id="imagemEvento" name="imagemEvento" accept="image/*" >
        </div>

        <div class="form">
            <button name="enviar" type="submit" class="btnEnviar">Enviar Projeto</button>
        </div>
    </form>
</div>