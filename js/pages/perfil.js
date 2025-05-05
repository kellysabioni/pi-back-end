function botoesPerfil() {
    const meusProjetos = document.getElementById ('meusProjetos');
    const projetosSeguidos = document.getElementById ('projetosSeguidos');
    const projetosCriados = document.getElementById ('projetosCriados');

    const meusProjetosBtn = document.getElementById ('meusProjetosBtn');
    const projetosSeguidosBtn = document.getElementById ('projetosSeguidosBtn');
    const projetosCriadosBtn = document.getElementById ('projetosCriadosBtn');

    [meusProjetosBtn, projetosSeguidosBtn, projetosCriadosBtn].forEach(botao => {
        botao.classList.remove('ativo');
    });

    [meusProjetos, projetosSeguidos, projetosCriados].forEach(conteudo => {
        conteudo.style.display = 'none';
    });

    if (this.id === 'meusProjetos') {
        meusProjetosBtn.classList.add('ativo');
        meusProjetos.style.display = 'block';
    } else if (this.id === 'projetosSeguidos') {
        projetosSeguidosBtn.classList.add('ativo');
        projetosSeguidos.style.display = 'block';
    } else if (this.id === 'projetosCriados') {
        projetosCriadosBtn.classList.add('ativo');
        projetosCriados.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const perfilBotao = document.querySelectorAll('perfil-botao');
    if (perfilBotao.length > 0) {
        perfilBotao.forEach(botao => {
            botao.addEventListener('click', botoesPerfil)
        });
    }
});