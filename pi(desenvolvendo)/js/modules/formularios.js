export function alterarFormularios() {
    const btnProjeto = document.getElementById('btnProjeto');
    const btnEvento = document.getElementById('btnEvento');
    const formularios = document.querySelector('.formularios');
    const titulo = formularios.querySelector('h2');
    const formEvento = document.getElementById('formEvento');

    function alterarProjeto() {
        titulo.textContent = 'Criar Novo Projeto';
        formEvento.id = 'formProjeto';

        const nomes = formEvento.querySelectorAll('[id*="Evento"], [name*="Evento"], [for*="Evento"]');
        nomes.forEach(nome => {
            if(nome.id) {
                nome.id = nome.id.replace('Evento', 'Projeto')
            }

            if (nome.name) {
                nome.name = nome.name.replace('Evento', 'Projeto')
            }

            if (nome.htmlFor) {
                nome.htmlFor = nome.htmlFor.replace ('Evento', 'Projeto')
            }
        })
    }

    function alterarEvento() {
        titulo.textContent = 'Criar Novo Evento';
        formEvento.id = 'formEvento';

        const nomes = formEvento.querySelectorAll('[id*="Projeto"], [name*="Projeto"], [for*="Projeto"]');
        nomes.forEach(nome => {
            if(nome.id) {
                nome.id = nome.id.replace('Projeto', 'Evento')
            }

            if (nome.name) {
                nome.name = nome.name.replace('Projeto', 'Evento')
            }

            if (nome.htmlFor) {
                nome.htmlFor = nome.htmlFor.replace ('Projeto', 'Evento')
            }
        })
    }

    if (btnProjeto && btnEvento) {
        btnProjeto.addEventListener('click', alterarProjeto);
        btnEvento.addEventListener('click', alterarEvento);
    } else {
        console.error('Botões não encontrados!');
    }
}