<?php

use ProjetaBD\Models\Usuario;
use ProjetaBD\Services\UsuarioServico;

require_once "../vendor/autoload.php";

$usuarioServico = new UsuarioServico();

if (isset($_POST['enviar'])) {
     $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
     $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
     $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    $usuario = new Usuario();
    $usuarioServico->inserir($usuario);

    header("");
    exit;
}
?>
<div id="loginModal" class="login-modal">
    <div class="login-container">
        <span class="login-fechar" onclick="fecharLoginModal()">&times;</span>
        
        <div class="login-header">
            <h2 class="login-titulo">Cadastrar</h2>
        </div>

        <form id="cadastroForm" class="login-form">
            <div class="login-grupo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="usuario" required>
            </div>
            <div class="login-grupo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="login-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <div class="login-acoes">
                <button name="enviar" type="submit" class="login-botao primario" >
                    Cadastrar
                </button>
            </div>
        </form>

    </div>
</div> 