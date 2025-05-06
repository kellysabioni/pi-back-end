import {
    buscarCEP
} from '../modules/cep.js';

document.addEventListener('DOMContentLoaded', () => {

    document.getElementById('buscarBtn').addEventListener('click', function (e) {
        e.preventDefault();
        const cep = document.getElementById('cep').value;
        buscarCEP(cep, 'resultado')

        const formCep = document.querySelectorAll('.formCep');
        formCep.forEach(el => el.classList.add('ativo'));
    });

    const url = new URLSearchParams(window.location.search);
    const nome = url.get('nome');
    if (nome) {
        const nomeEvento = document.getElementById('nomeEvento');
        if (nomeEvento) {
            nomeEvento.value = nome;
        }
    }
});
