<div class="formularios" id="formProjeto">
    <h2>Criar Novo Projeto</h2>

    <form>
        <div class="form">
            <label for="nomeProjeto">Nome do Projeto</label>
            <input type="text" id="nomeProjeto" name="nomeProjeto" placeholder="Digite o nome do Projeto" required>
        </div>

        <div class="form">
            <label for="descricaoProjeto">Descrição</label>
            <textarea name="descricaoProjeto" id="descricaoProjeto" placeholder="Descreva o Projeto" required></textarea>
        </div>

        <div class="form">
            <label for="horarioProjeto">Horario</label>
            <input type="time" name="horarioProjeto" id="horarioProjeto" required>
        </div>

        <div class="form">
            <label for="cep">CEP</label>
            <div class="cep">
                <input type="text" name="cep" id="cep" maxlength="9" placeholder="00000-000" required>
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
            <input type="text" id="complemento" name="complemento">
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
            <input type="text" id="estado" name="estado" required>
        </div>

        <div class="form">
            <label for="celulaProjeto">Telefone</label>
            <input type="text" id="celular" name="celularProjeto" maxlength="15" placeholder="(00) 00000-0000" required>
        </div>

        <div class="form">
            <label for="imagemProjeto">Imagem do Projeto</label>
            <input type="file" id="imagemProjeto" name="imagemProjeto" accept="image/*" required>
        </div>

        <div class="form">
            <button type="submit" class="btnEnviar">Enviar</button>
        </div>
    </form>
</div>