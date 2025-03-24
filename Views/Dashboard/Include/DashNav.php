<nav class="navbar d-flex justify-content-between align-items-center">
    <!-- Botón de ocultar/mostrar sidebar -->
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-toggle" id="toggleSidebar">
            <i class="bi bi-list"></i>
        </button>
        <h5 class="mb-0">¡Hola, <span class="text-success fw-bold"><?php echo $_SESSION['usuario_nombre']; ?></span>! Bienvenido :)</h5>
    </div>



    <!-- Perfil del usuario -->
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> <?php echo $_SESSION['usuario_nombre'] ?>
        </button>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li>
                <a class="dropdown-item" href="#">
                    <i class="fa-solid fa-user"></i> 
                    <span class="ms-2">Perfil</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="#" id="cerrarSesion">
                    <i class="fa-solid fa-power-off"></i> 
                    <span class="ms-2">Cerrar sesión</span>
                </a>
            </li>
        </ul>
    </div>
</nav>