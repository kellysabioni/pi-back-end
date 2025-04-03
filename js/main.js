
// Funções para manipulação dos modais
const loginModal = document.getElementById('loginModal');
const registerModal = document.getElementById('registerModal');
const loginBtn = document.getElementById('loginBtn');
const registerBtn = document.getElementById('registerBtn');
const closeButtons = document.querySelectorAll('.close');

// Abrir modal de login
loginBtn.onclick = () => {
    loginModal.style.display = "block";
}

// Abrir modal de cadastro
registerBtn.onclick = () => {
    registerModal.style.display = "block";
}

// Fechar modais
closeButtons.forEach(button => {
    button.onclick = () => {
        loginModal.style.display = "none";
        registerModal.style.display = "none";
    }
});

// Fechar modal ao clicar fora
window.onclick = (event) => {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
        registerModal.style.display = "none";
    }
}
