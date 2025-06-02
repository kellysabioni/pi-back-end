<?php
session_start();

use ProjetaBD\Enums\Categoria;
use ProjetaBD\Helpers\Utils;
use ProjetaBD\Models\Evento;
use ProjetaBD\Services\EventoServico;
use ProjetaBD\Services\ProjetoServico;
use ProjetaBD\Services\FotoServico;
use ProjetaBD\Auth\ControleDeAcesso;
use ProjetaBD\Helpers\Validacoes;

require_once "vendor/autoload.php";

ControleDeAcesso::exigirLogin();

$eventoServico = new EventoServico();
$projetoServico = new ProjetoServico();

// Get event ID from URL
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$evento = $eventoServico->listarUm($id)[0];
$projetos = $projetoServico->listarTodosUser($_SESSION['id']);

// echo "<pre>";
// var_dump($evento);
// echo "</pre>";
// die();



if (isset($_POST['atualizar'])) {
    try {
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);
        $data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
        $hora = filter_input(INPUT_POST, "hora", FILTER_SANITIZE_SPECIAL_CHARS);
   
        if (!empty($hora)) {
            $horaFormatada = date('H:i', strtotime($hora));
            $hora = $horaFormatada;
        }
        
        $CEP = filter_input(INPUT_POST, "CEP", FILTER_SANITIZE_SPECIAL_CHARS);
        $rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
        $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);
        $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
        $UF = filter_input(INPUT_POST, "UF", FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = Categoria::from(filter_input(INPUT_POST, "categoriaEvento", FILTER_SANITIZE_SPECIAL_CHARS));
        $projetos_id = filter_input(INPUT_POST, "id_projeto", FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Validações
        Validacoes::validarNome($nome);
        Validacoes::validarDescricao($descricao);
        Validacoes::validarData($data);
        Validacoes::validarHora($hora);
        Validacoes::validarCEP($CEP);
        Validacoes::validarEndereco($rua);
        Validacoes::validarNumero($numero);
        Validacoes::validarBairro($bairro);
        Validacoes::validarCidade($cidade);
        Validacoes::validarUF($UF);
        Validacoes::validarTelefone($telefone);
        Validacoes::validarCategoria($categoria->value);
        
        $projetos_id = ($projetos_id === "-1") ? null : $projetos_id;

        $eventoAtualizado = new Evento(
            $nome, 
            $descricao, 
            $data, 
            $hora, 
            $CEP, 
            $rua, 
            $numero, 
            $bairro, 
            $cidade, 
            $UF, 
            $telefone, 
            $categoria, 
            $projetos_id,
            $evento['created_at'],
            date('Y-m-d H:i:s'),
            $evento['usuarios_id'],
            $id
        );
        
        $eventoServico->atualizar($eventoAtualizado);

        // Se houver nova imagem, faz o upload e atualiza
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $nomeDaImagem = Utils::upload($_FILES['imagem']);
            if ($nomeDaImagem) {
                $fotoServico = new FotoServico();
                $fotoServico->atualizar($nomeDaImagem, $evento['usuarios_id'], $id, null);
            }
        }

        header("location: perfil.php");
        exit;
    } catch (InvalidArgumentException $e) {
        $mensagemErro = $e->getMessage();
    } catch (Throwable $e) {
        $mensagemErro = "Erro ao atualizar evento: " . $e->getMessage();
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
    <title>Atualizar Evento</title>
</head>
<body>
    <main>
        <div class="formularios" id="formEvento">
            <h2>Atualizar Evento</h2>

            <?php if (isset($mensagemErro)): ?>
                <div class="mensagem-erro">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $mensagemErro ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form">
                    <label for="nomeEvento">Nome do Evento </label>
                    <input type="text" id="nomeEvento" name="nome" value="<?= $evento['nome'] ?>" required>
                </div>

                <div class="form">
                    <label for="categoriaEvento">Categoria </label>
                    <select name="categoriaEvento" id="categoriaEvento">
                        <?php foreach (Categoria::cases() as $categoria): ?>
                            <option value="<?= $categoria->value ?>" <?= $evento['categoria'] === $categoria->value ? 'selected' : '' ?>>
                                <?= $categoria->value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form">
                    <label for="relacionaProjeto">Projeto</label>
                    <small>Deseja relacionar a algum projeto?</small>
                    <select name="id_projeto" id="relacionaProjeto">
                        <option value="-1" <?= empty($evento['projetos_id']) ? 'selected' : '' ?>>nenhum</option>
                        <?php foreach ($projetos as $projeto): ?>
                            <option value="<?= $projeto['id'] ?>" <?= $evento['projetos_id'] == $projeto['id'] ? 'selected' : '' ?>>
                                <?= $projeto['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form">
                    <label for="descricaoEvento">Descrição </label>
                    <textarea name="descricao" id="descricaoEvento" required><?= $evento['descricao'] ?></textarea>
                </div>

                <div class="form">
                    <label for="dataEvento">Data </label>
                    <input type="date" name="data" id="dataEvento" value="<?= $evento['data'] ?>" required>
                </div>

                <div class="form">
                    <label for="horarioEvento">Horário </label>
                    <input type="time" name="hora" id="horarioEvento" value="<?= $evento['hora'] ?>" >
                </div>

                <div class="form">
                    <label for="cep">CEP </label>
                    <div class="cep">
                        <input type="text" name="CEP" id="cep" value="<?= $evento['CEP'] ?>" required>
                        <button type="button" id="buscarBtn" class="btnCEP">buscar</button>
                    </div>
                    <div id="resultado"></div>
                </div>

                <div class="form formCep">
                    <label for="rua">Rua </label>
                    <input type="text" id="rua" name="rua" value="<?= $evento['rua'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="complemento">Número </label>
                    <input type="text" id="complemento" name="numero" value="<?= $evento['numero'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="bairro">Bairro </label>
                    <input type="text" id="bairro" name="bairro" value="<?= $evento['bairro'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="cidade">Cidade </label>
                    <input type="text" id="cidade" name="cidade" value="<?= $evento['cidade'] ?>" required>
                </div>

                <div class="form formCep">
                    <label for="estado">Estado </label>
                    <input type="text" id="estado" name="UF" value="<?= $evento['UF'] ?>" required>
                </div>

                <div class="form">
                    <label for="celular">Telefone </label>
                    <input type="tel" id="celular" name="telefone" value="<?= $evento['telefone'] ?>" required>
                </div>

                <div class="form">
                    <label for="imagemEvento">Nova Imagem do Evento (opcional)</label>
                    <input type="file" id="imagemEvento" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
                </div>

                <div class="form">
                    <button name="atualizar" type="submit" class="btnEnviar">Atualizar</button>
                </div>

                <div class="form">
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