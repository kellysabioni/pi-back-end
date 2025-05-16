
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
            <a class="login-link" >
                Cadastrar-se
            </a>
        </form>

        <div class="login-acoes">
            <button class="login-botao primario" >
                Entrar
            </button>
            <a class="login-link">
                Continuar sem login
            </a>
        </div>
    </div>
</div> 