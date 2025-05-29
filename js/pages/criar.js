import {
    buscarCEP
} from '../modules/cep.js';

// Mascara via api IMask
document.addEventListener('DOMContentLoaded', () => {
    const cepElement = document.getElementById('cep');
    const celularElement = document.getElementById('celular');

    if (cepElement) {
        IMask(cepElement, {
            mask: '00000-000'
        });
    }

    if (celularElement) {
        IMask(celularElement, {
            mask: '(00) 00000-0000'
        });
    }

    document.getElementById('buscarBtn').addEventListener('click', function (e) {
        e.preventDefault();
        const cep = document.getElementById('cep').value;
        buscarCEP(cep, 'resultado');
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
