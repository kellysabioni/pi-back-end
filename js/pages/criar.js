import {
    buscarCEP
} from '../modules/cep.js';
import {
    alterarFormularios
} from '../modules/formularios.js';

document.addEventListener('DOMContentLoaded', () => {

    document.getElementById('buscarBtn').addEventListener('click', function (e) {
        e.preventDefault();
        const cep = document.getElementById('cep').value;
        buscarCEP(cep, 'resultado')

        const formCep = document.querySelectorAll('.formCep');
        formCep.forEach(el => el.classList.add('ativo'));
    });
    alterarFormularios();

    const url = new URLSearchParams(window.location.search);
    const nome = url.get('nome');
    if (nome) {
        const nomeEvento = document.getElementById('nomeEvento');
        if (nomeEvento) {
            nomeEvento.value = nome;
        }
    }
});

const botoes = document.querySelectorAll('.criar-botao');

botoes.forEach(botao => botao.classList.remove('ativo'));

const botaoEvento = document.getElementById('btnProjeto');
if (botaoEvento) botaoEvento.classList.add('ativo');

botoes.forEach(botao => {
    botao.addEventListener('click', () => {
        botoes.forEach(botao => botao.classList.remove('ativo'));

        botao.classList.add('ativo');
    });
});