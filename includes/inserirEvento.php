<div class="formularios" id="formEvento">
            <h2>Criar Novo Evento</h2>

            <form>
                <div class="form">
                    <label for="nomeEvento">Nome do Evento</label>
                    <input type="text" id="nomeEvento" name="nomeEvento" placeholder="Digite o nome do Evento" required>
                </div>

                <div class="form">
                    <label for="descricaoEvento">Descrição</label>
                    <textarea name="descricaoEvento" id="descricaoEvento" placeholder="Descreva o Evento" required></textarea>
                </div>

                <div class="form">
                    <label for="dataEvento">Data</label>
                    <input type="date" name="dataEvento" id="dataEvento" required>
                </div>

                <div class="form">
                    <label for="horarioEvento">Horario</label>
                    <input type="time" name="horarioEvento" id="horarioEvento" required>
                </div>

                <div class="form">
                    <label for="cep">CEP</label>
                    <div class="cep">
                        <input type="text" name="cep" id="cep" placeholder="00000-000" required>
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
                    <label for="celularEvento">Telefone</label>
                    <input type="tel" id="celularEvento" name="celularEvento" required placeholder="99-9999-9999">
                </div>

                <div class="form">
                    <label for="imagemEvento">Imagem do Evento</label>
                    <input type="file" id="imagemEvento" name="imagemEvento" accept="image/*" required>
                </div>
            </form>
        </div>