<?php

use ProjetaBD\Enums\Categoria;
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Models\Evento;
use ProjetaBD\Services\EventoServico;
use ProjetaBD\Services\FotoServico;
use ProjetaBD\Services\ProjetoServico;

require_once __DIR__ . "/../vendor/autoload.php";

$eventoServico = new EventoServico();
$fotoServico = new FotoServico();
$projetoServico = new ProjetoServico();

$projetos = $projetoServico->listarTodosUser($_SESSION['id']);


if (isset($_POST['enviar'])) {
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);
    $data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
    $hora = filter_input(INPUT_POST, "hora", FILTER_SANITIZE_SPECIAL_CHARS);
    $CEP = filter_input(INPUT_POST, "CEP", FILTER_SANITIZE_SPECIAL_CHARS);
    $rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
    $UF = filter_input(INPUT_POST, "UF", FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = Categoria::from(filter_input(INPUT_POST, "categoriaEvento", FILTER_SANITIZE_SPECIAL_CHARS));
    $usuarios_id = $_SESSION['id'];
    $projetos_id = filter_input(INPUT_POST, "id_projeto", FILTER_SANITIZE_SPECIAL_CHARS);

    try {
        // Primeiro, insere o evento
        $evento = new Evento(
            $nome, $descricao, $data, $hora, $CEP, $rua, $numero, $bairro, $cidade, $UF, $telefone, $categoria, $projetos_id,date('Y-m-d H:i:s'), date('Y-m-d H:i:s'),$usuarios_id
        );
        
        $eventoServico->inserir($evento);
        
        // Pega o ID do evento inserido
        $eventoId = $eventoServico->getConexao()->lastInsertId();
        
        // Se houver imagem, faz o upload e salva na tabela fotos
        if (isset($_FILES['imagem'])) {
            error_log("Arquivo recebido: " . print_r($_FILES['imagem'], true));
            
            if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $nomeDaImagem = Utils::upload($_FILES['imagem']);
                error_log("Nome da imagem após upload: " . $nomeDaImagem);
                
                if ($nomeDaImagem) {
                    $fotoServico->inserir($nomeDaImagem, $usuarios_id, $eventoId);
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
    } catch (Throwable $e) {
        error_log("Erro ao processar evento: " . $e->getMessage());
        $mensagemErro = $e->getMessage();
    }
}

?>

<div class="formularios" id="formEvento">
    <h2>Criar Novo Evento</h2>
    

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form">
            <label for="nomeEvento">Nome do Evento</label>
            <input type="text" id="nomeEvento" name="nome" placeholder="Digite o nome do Evento" required>
        </div>

        <div class="form">
            <label for="categoriaEvento">Categoria</label>
            <select name="categoriaEvento" id="categoriaEvento">
                <?php foreach (\ProjetaBD\Enums\Categoria::cases() as $categoria): ?>
                    <option value="<?=$categoria->value?>">
                        <?= $categoria->value ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form">
            <label for="relacionaProjeto">Projeto</label>
            <small>Deseja relacionar a algum projeto?</small>
            <select name="id_projeto" id="relacionaProjeto">
                    <option value="null">nenhum</option>
                <?php foreach ($projetos as $projeto): ?>
                    <option value="<?=$projeto['id']?>">
                        <?= $projeto['nome'] ?>
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
            <input type="time" name="hora" id="horarioEvento">
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
            <label for="celular">Telefone</label>
            <input type="tel" id="celular" name="telefone" required placeholder="(00) 00000-0000">
        </div>

        <div class="form">
            <label for="imagemEvento">Imagem do Evento</label>
            <input type="file" id="imagemEvento" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml" required>
        </div>

        <div class="form">
            <button name="enviar" type="submit" class="btnEnviar">Enviar</button>
        </div>
    </form>
</div>