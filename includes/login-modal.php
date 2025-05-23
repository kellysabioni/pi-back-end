

<div id="loginModal" class="login-modal">
    <div class="login-container">
        <span class="login-fechar" onclick="fecharLoginModal()">&times;</span>
        <div class="login-header">
            <h2 class="login-titulo">Entrar</h2>
        </div>
        <form id="loginForm" class="login-form" method="POST" action="">
            <div class="login-grupo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="login-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="login-acoes">
                <p>Ainda não tem uma conta?
                    <a href="cadastrar.php" class="login-link >">Cadastrar-se</a> agora e aproveite todos os recursos!
                </p>
                <button name="enviar" type="submit" class="login-botao primario">Enviar</button>
            </div>
        </form>
    </div>
</div>