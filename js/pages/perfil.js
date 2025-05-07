(function() {
    function initPerfil() {

        const botoes = {
            meusProjetos: document.getElementById('meusProjetosBtn'),
            projetosSeguidos: document.getElementById('projetosSeguidosBtn'),
            projetosCriados: document.getElementById('projetosCriadosBtn')
        };

        const conteudos = {
            meusProjetos: document.getElementById('meusProjetos'),
            projetosSeguidos: document.getElementById('projetosSeguidos'),
            projetosCriados: document.getElementById('projetosCriados')
        };

        function removerClasseAtivo() {
            Object.values(botoes).forEach(botao => botao.classList.remove('ativo'));
            Object.values(conteudos).forEach(conteudo => conteudo.classList.remove('ativo'));
        }

        function ativarAba(botao, conteudo) {
            removerClasseAtivo();
            botao.classList.add('ativo');
            conteudo.classList.add('ativo');
        }

        botoes.meusProjetos.addEventListener('click', () => {
            ativarAba(botoes.meusProjetos, conteudos.meusProjetos);
        });

        botoes.projetosSeguidos.addEventListener('click', () => {
            ativarAba(botoes.projetosSeguidos, conteudos.projetosSeguidos);
        });

        botoes.projetosCriados.addEventListener('click', () => {
            ativarAba(botoes.projetosCriados, conteudos.projetosCriados);
        });

        ativarAba(botoes.meusProjetos, conteudos.meusProjetos);
    }

    // Aguarda o DOM estar completamente carregado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPerfil);
    } else {
        initPerfil();
    }
})();
