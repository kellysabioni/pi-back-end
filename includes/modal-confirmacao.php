<!-- Modal de Confirmação -->
<div id="deleteModal" class="modal-confirmar">
    <div class="modal-container">
        <h3 class="modal-titulo">Confirmar Exclusão</h3>
        <p>Tem certeza que deseja excluir este item?</p>
        <div class="modal-botoes">
            <button class="modal-botao cancelar-botao" onclick="closeModal()">Cancelar</button>
            <button class="modal-botao confirmar-botao" id="confirmDelete">Excluir</button>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(id, tipo) {
        const modal = document.getElementById('deleteModal');
        if (!modal) {
            console.error('Modal não encontrado');
            return;
        }
        modal.style.display = 'flex';
        
        const confirmButton = document.getElementById('confirmDelete');
        if (confirmButton) {
            confirmButton.onclick = function() {
                window.location.href = `?id=${id}&tipo=${tipo}&confirmar-exclusao`;
            };
        }
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Fechar modal ao clicar fora dele
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script> 