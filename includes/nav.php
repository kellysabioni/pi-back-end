<nav class="nav">
    <div class="links">
        <a href="perfil.php" class="nav-icons">
            <i id="user" class="fa-regular fa-user"></i>
            <!-- <span>Perfil</span> -->
        </a>
        <a href="index.php" class="nav-icons">
            <i id="fy" class="fa-regular fa-compass"></i>
            <!-- <span>Explorar</span> -->
        </a>
        <a href="admin/criar.php?tipo=evento" class="nav-icons">
            <i id="criar" class="fa-regular fa-square-plus"></i>
            <!-- <span>Criar</span> -->
        </a>
    </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Pega apenas o nome da página (ex: 'perfil.php')
    const path = window.location.pathname.split('/').pop();

    // Mapeia página → ID do ícone
    const pageToIcon = {
      'perfil.php': 'user',
      'index.php': 'fy',
      'criar.php': 'criar'
    };

    const iconId = pageToIcon[path];

    if (iconId) {
      const icon = document.getElementById(iconId);
      if (icon) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid');
      }
    }
  });
</script>

