// Dados de exemplo para projetos e eventos
const sampleProjects = [
    {
        id: 1,
        title: "Projeto Verde Vida",
        description: "Iniciativa de reflorestamento urbano",
        image: "images/project1.jpg",
        organizer: "ONG Verde Vida",
        followers: 1200
    },
    {
        id: 2,
        title: "Educação para Todos",
        description: "Projeto de alfabetização de adultos",
        image: "images/project2.jpg",
        organizer: "Instituto Educação",
        followers: 850
    }
];

const sampleEvents = [
    {
        id: 1,
        title: "Plantio de Árvores",
        date: "15/04/2024",
        location: "Parque Central",
        projectId: 1,
        participants: 45
    },
    {
        id: 2,
        title: "Aula Inaugural",
        date: "20/04/2024",
        location: "Centro Comunitário",
        projectId: 2,
        participants: 30
    }
];

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

// Manipulação dos formulários
document.getElementById('loginForm').onsubmit = (e) => {
    e.preventDefault();
    alert('Login realizado com sucesso!');
    loginModal.style.display = "none";
}

document.getElementById('registerForm').onsubmit = (e) => {
    e.preventDefault();
    alert('Cadastro realizado com sucesso!');
    registerModal.style.display = "none";
}

// Função para criar cards de projetos
function createProjectCard(project) {
    return `
        <div class="project-card">
            <img src="${project.image}" alt="${project.title}">
            <h3>${project.title}</h3>
            <p>${project.description}</p>
            <div class="project-info">
                <span>Organizador: ${project.organizer}</span>
                <span>Seguidores: ${project.followers}</span>
            </div>
            <button class="follow-button">Seguir Projeto</button>
        </div>
    `;
}

// Função para criar cards de eventos
function createEventCard(event) {
    return `
        <div class="event-card">
            <h3>${event.title}</h3>
            <p>Data: ${event.date}</p>
            <p>Local: ${event.location}</p>
            <p>Participantes: ${event.participants}</p>
            <button class="join-button">Participar</button>
        </div>
    `;
}

// Função para carregar projetos na página
function loadProjects() {
    const projectsGrid = document.querySelector('.projects-grid');
    projectsGrid.innerHTML = sampleProjects.map(createProjectCard).join('');
}

// Função para carregar eventos na página
function loadEvents() {
    const eventsGrid = document.querySelector('.events-grid');
    eventsGrid.innerHTML = sampleEvents.map(createEventCard).join('');
}

// Carregar conteúdo quando a página for carregada
document.addEventListener('DOMContentLoaded', () => {
    loadProjects();
    loadEvents();
});

// Adicionar eventos aos botões de seguir e participar
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('follow-button')) {
        e.target.textContent = 'Seguindo';
        e.target.disabled = true;
    }
    if (e.target.classList.contains('join-button')) {
        e.target.textContent = 'Inscrito';
        e.target.disabled = true;
    }
}); 