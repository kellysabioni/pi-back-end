document.addEventListener('DOMContentLoaded', function () {
    const postCard = document.querySelectorAll(".post");  
    const postModal = document.getElementById('postModal');
    const postModalFechar = document.querySelector('.fechar-modal');

    postCard.forEach(card => {
        card.addEventListener('click', function () {
            postModal.style.display = 'block';  
            postModal.offsetHeight;  
            postModal.classList.add('ativo');  

            document.body.style.overflow = 'hidden';  
        });
    });

    function fecharModal() {
        postModal.classList.remove('ativo');
        setTimeout(() => {
            postModal.style.display = 'none';
            document.body.style.overflow = 'auto'; 
        }, 300); 
    }
 
    postModalFechar.addEventListener('click', fecharModal);

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

