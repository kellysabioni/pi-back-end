// Funções para manipulação dos modais
const loginModal = document.getElementById('loginModal');
const registerModal = document.getElementById('registerModal');
const loginBtn = document.getElementById('loginBtn');
const registerBtn = document.getElementById('registerBtn');
const closeButtons = document.querySelectorAll('.close');

// Controle do Menu Lateral
const menuToggle = document.getElementById('menuToggle');
const sideMenu = document.getElementById('sideMenu');
const closeMenu = document.getElementById('closeMenu');

// Abrir menu lateral
menuToggle.onclick = () => {
    sideMenu.classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Fechar menu lateral
closeMenu.onclick = () => {
    sideMenu.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Fechar menu ao clicar fora
window.onclick = (event) => {
    if (event.target == sideMenu) {
        sideMenu.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
        registerModal.style.display = "none";
    }
}

// Funções para manipulação das postagens
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os post-cards
    const postCards = document.querySelectorAll('.post-card');
    const postModal = document.getElementById('postModal');
    const postModalClose = document.querySelector('.post-modal-close');

    // Adiciona evento de clique para cada post-card
    postCards.forEach(card => {
        card.addEventListener('click', function() {
            postModal.style.display = 'block';
            // Força um reflow antes de adicionar a classe active
            postModal.offsetHeight;
            postModal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Previne rolagem do body
        });
    });

    // Fecha o modal quando clicar no X
    postModalClose.addEventListener('click', closeModal);

    // Fecha o modal quando clicar fora dele
    window.addEventListener('click', function(event) {
        if (event.target === postModal) {
            closeModal();
        }
    });

    // Função para fechar o modal com animação
    function closeModal() {
        postModal.classList.remove('active');
        setTimeout(() => {
            postModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }, 300); // Tempo igual à duração da transição CSS
    }

    // Controle dos modais de Login e Registro
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const closeButtons = document.querySelectorAll('.close');

    loginBtn.addEventListener('click', function() {
        loginModal.style.display = 'block';
    });

    registerBtn.addEventListener('click', function() {
        registerModal.style.display = 'block';
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target === loginModal) {
            loginModal.style.display = 'none';
        }
        if (event.target === registerModal) {
            registerModal.style.display = 'none';
        }
    });
});

// Função para alternar entre os formulários de projeto e evento
function toggleForm() {
    const projectForm = document.getElementById('projectForm');
    const eventForm = document.getElementById('eventForm');
    const projectTab = document.getElementById('projectTab');
    const eventTab = document.getElementById('eventTab');
    
    if (projectForm.style.display === 'none') {
        projectForm.style.display = 'block';
        eventForm.style.display = 'none';
        projectTab.classList.add('active');
        eventTab.classList.remove('active');
    } else {
        projectForm.style.display = 'none';
        eventForm.style.display = 'block';
        projectTab.classList.remove('active');
        eventTab.classList.add('active');
    }
}

// Função para atualizar os campos do formulário de projeto
function updateProjectForm() {
    const formTitle = document.getElementById('formTitle');
    const projectName = document.getElementById('projectName');
    const projectDescription = document.getElementById('projectDescription');
    const projectCategory = document.getElementById('projectCategory');
    const projectLocation = document.getElementById('projectLocation');
    const projectImage = document.getElementById('projectImage');
    const submitButton = document.getElementById('submitButton');

    // Atualiza os placeholders e labels
    formTitle.textContent = 'Criar Novo Projeto';
    projectName.placeholder = 'Nome do Projeto';
    projectDescription.placeholder = 'Descreva seu projeto...';
    projectCategory.innerHTML = `
        <option value="">Selecione uma categoria</option>
        <option value="educacao">Educação</option>
        <option value="meio-ambiente">Meio Ambiente</option>
        <option value="saude">Saúde</option>
        <option value="cultura">Cultura</option>
        <option value="social">Social</option>
    `;
    projectLocation.placeholder = 'Local do projeto';
    submitButton.textContent = 'Criar Projeto';

    // Adiciona efeito visual de transição
    const formElements = [projectName, projectDescription, projectCategory, projectLocation, projectImage];
    formElements.forEach(element => {
        element.style.transition = 'all 0.3s ease';
        element.style.transform = 'scale(1.05)';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
        }, 300);
    });
}

// Função para atualizar os campos do formulário de evento
function updateEventForm() {
    const formTitle = document.getElementById('formTitle');
    const eventName = document.getElementById('eventName');
    const eventDescription = document.getElementById('eventDescription');
    const eventDate = document.getElementById('eventDate');
    const eventTime = document.getElementById('eventTime');
    const eventLocation = document.getElementById('eventLocation');
    const eventImage = document.getElementById('eventImage');
    const submitButton = document.getElementById('submitButton');

    // Atualiza os placeholders e labels
    formTitle.textContent = 'Criar Novo Evento';
    eventName.placeholder = 'Nome do Evento';
    eventDescription.placeholder = 'Descreva seu evento...';
    eventDate.placeholder = 'Data do evento';
    eventTime.placeholder = 'Horário do evento';
    eventLocation.placeholder = 'Local do evento';
    submitButton.textContent = 'Criar Evento';

    // Adiciona efeito visual de transição
    const formElements = [eventName, eventDescription, eventDate, eventTime, eventLocation, eventImage];
    formElements.forEach(element => {
        element.style.transition = 'all 0.3s ease';
        element.style.transform = 'scale(1.05)';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
        }, 300);
    });
}

// Adiciona os event listeners quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    const projectTab = document.getElementById('projectTab');
    const eventTab = document.getElementById('eventTab');
    
    if (projectTab && eventTab) {
        projectTab.addEventListener('click', function() {
            toggleForm();
            updateProjectForm();
        });
        
        eventTab.addEventListener('click', function() {
            toggleForm();
            updateEventForm();
        });
    }
});

// Função para alternar entre as tabs do perfil
function toggleProfileTabs() {
    const myProjectsTab = document.getElementById('myProjectsTab');
    const followedProjectsTab = document.getElementById('followedProjectsTab');
    const createdProjectsTab = document.getElementById('createdProjectsTab');
    
    const myProjectsContent = document.getElementById('myProjectsContent');
    const followedProjectsContent = document.getElementById('followedProjectsContent');
    const createdProjectsContent = document.getElementById('createdProjectsContent');

    // Remove a classe active de todas as tabs
    [myProjectsTab, followedProjectsTab, createdProjectsTab].forEach(tab => {
        tab.classList.remove('active');
    });

    // Esconde todo o conteúdo
    [myProjectsContent, followedProjectsContent, createdProjectsContent].forEach(content => {
        content.style.display = 'none';
    });

    // Adiciona a classe active na tab clicada e mostra o conteúdo correspondente
    if (this.id === 'myProjectsTab') {
        myProjectsTab.classList.add('active');
        myProjectsContent.style.display = 'block';
    } else if (this.id === 'followedProjectsTab') {
        followedProjectsTab.classList.add('active');
        followedProjectsContent.style.display = 'block';
    } else if (this.id === 'createdProjectsTab') {
        createdProjectsTab.classList.add('active');
        createdProjectsContent.style.display = 'block';
    }
}

// Adiciona os event listeners para as tabs do perfil
document.addEventListener('DOMContentLoaded', function() {
    const profileTabs = document.querySelectorAll('.profile-tab');
    if (profileTabs.length > 0) {
        profileTabs.forEach(tab => {
            tab.addEventListener('click', toggleProfileTabs);
        });
    }
});

// Adiciona evento de clique ao botão de cadastro no hero
const heroRegisterBtn = document.getElementById('heroRegisterBtn');
if (heroRegisterBtn) {
    heroRegisterBtn.addEventListener('click', () => {
        const registerModal = document.getElementById('registerModal');
        if (registerModal) {
            registerModal.style.display = 'block';
        }
    });
}

// Controle da barra de pesquisa
const searchToggle = document.getElementById('searchToggle');
const searchBar = document.querySelector('.search-bar');

if (searchToggle && searchBar) {
    searchToggle.addEventListener('click', () => {
        searchBar.classList.toggle('active');
        if (searchBar.classList.contains('active')) {
            searchBar.querySelector('input').focus();
        }
    });

    // Fechar a barra de pesquisa ao clicar fora
    document.addEventListener('click', (event) => {
        if (!searchBar.contains(event.target) && !searchToggle.contains(event.target)) {
            searchBar.classList.remove('active');
        }
    });

    // Fechar a barra de pesquisa ao pressionar ESC
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && searchBar.classList.contains('active')) {
            searchBar.classList.remove('active');
        }
    });
}

// Conectar os botões de login e cadastro do menu lateral
const sideLoginBtn = document.getElementById('sideLoginBtn');
const sideRegisterBtn = document.getElementById('sideRegisterBtn');

if (sideLoginBtn && sideRegisterBtn) {
    sideLoginBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const loginModal = document.getElementById('loginModal');
        if (loginModal) {
            loginModal.style.display = 'block';
            sideMenu.classList.remove('active');
        }
    });

    sideRegisterBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const registerModal = document.getElementById('registerModal');
        if (registerModal) {
            registerModal.style.display = 'block';
            sideMenu.classList.remove('active');
        }
    });
}
