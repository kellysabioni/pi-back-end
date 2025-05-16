
<div id="loginModal" class="login-modal">
    <div class="login-container">
        <span class="login-fechar" onclick="fecharLoginModal()">&times;</span>
        
        <div class="login-header">
            <h2 class="login-titulo">Login</h2>
        </div>

        <form id="loginForm" class="login-form">
            <div class="login-grupo">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="login-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
        </form>

        <div class="login-acoes">
            <button class="login-botao primario" onclick="fazerLogin()">
                Entrar
            </button>
            <button class="login-botao primario" onclick="fazerLogin()">
                Cadastra-se
            </button>
            <button class="login-botao secundario" onclick="continuarSemLogin()">
                Continuar sem login
            </button>
        </div>
    </div>
</div> 