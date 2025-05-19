
<div id="loginModal" class="login-modal">
    <div class="login-container">
        <span class="login-fechar" onclick="fecharLoginModal()">&times;</span>
        
        <div class="login-header">
            <h2 class="login-titulo">Cadastrar</h2>
        </div>

        <form id="cadastroForm" class="login-form" method="POST" action="">
            <div class="login-grupo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required>
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