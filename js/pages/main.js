// Espera o carregamento completo do DOM antes de executar o código
document.addEventListener('DOMContentLoaded', function () {
    
    // Seleciona todos os elementos com a classe "post"
    const postCard = document.querySelectorAll(".post");  
    
    // Seleciona o modal que será exibido quando o post for clicado
    const postModal = document.getElementById('postModal');

    // Seleciona o botão de fechar dentro do modal
    const postModalFechar = document.querySelector('.fechar-modal');

    // 1. Adiciona um evento de clique em cada card de post
    postCard.forEach(card => {
        card.addEventListener('click', function () {
            const id = card.id; // Pega o ID do card clicado
            // Redireciona a página incluindo o ID como parâmetro na URL
            window.location.href = `?id=${id}`;
        });
    });

    // 2. Verifica se há um parâmetro 'id' na URL (após o carregamento)
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id'); // Obtém o valor do parâmetro 'id'
    
    if (id) {
        // Exibe o modal (define o estilo para "block")
        postModal.style.display = 'block';
        
        // Força o navegador a "recalcular" o layout (repaint)
        postModal.offsetHeight;

        // Adiciona a classe que ativa a animação de entrada do modal
        postModal.classList.add('ativo');

        // Impede que o fundo da página role enquanto o modal estiver aberto
        document.body.style.overflow = 'hidden';
    }

    // 3. Função para fechar o modal
    function fecharModal() {
        // Remove a classe que ativa o modal (animação de saída)
        postModal.classList.remove('ativo');

        // Espera 300ms (tempo da animação) antes de esconder o modal
        setTimeout(() => {
            postModal.style.display = 'none'; // Esconde o modal
            document.body.style.overflow = 'auto'; // Permite rolagem novamente

            // Remove o parâmetro 'id' da URL sem recarregar a página
            const url = new URL(window.location);
            url.searchParams.delete('id');
            window.history.replaceState({}, '', url); // Atualiza a URL
        }, 300);
    }

    // Adiciona evento de clique no botão de fechar para executar a função de fechar
    if (postModalFechar) {
        postModalFechar.addEventListener('click', fecharModal);
    }

    // Fecha o modal se o usuário clicar fora da área de conteúdo do modal
    window.addEventListener('click', function (event) {
        if (event.target === postModal) {
            fecharModal();
        }
    });
});




function barraPesquisar() {
    const pesquisar = document.querySelector('.barra-pesquisar');
    const criar = document.querySelector('.barra-criar');

    pesquisar.classList.toggle('ativo');
    criar.classList.remove('ativo');
}

function barraCriar() {
    const criar = document.querySelector('.barra-criar');
    const pesquisar = document.querySelector('.barra-pesquisar');

    criar.classList.toggle('ativo');
    pesquisar.classList.remove('ativo');
}

function aoPressionar(event) {
    if (event.key === 'Enter') {
        const criar = document.querySelector('.barra-criar');
        const nome = criar.value.trim();

        if (nome) {
            window.location.href = `criar.php?tipo=evento&nome=${encodeURIComponent(nome)}`;
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const input = document.querySelector('.barra-criar');
    input.addEventListener('keydown', aoPressionar);
});





