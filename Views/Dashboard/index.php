<?php
// Iniciar sesión solo si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Verificar si el usuario está autenticado antes de incluir cualquier archivo
if (!isset($_SESSION['usuario_nombre'])) {

    // Limpiar cualquier salida previa antes de redirigir
    if (ob_get_length()) {
        ob_clean();
    }

    header("Location: " . BASE_URL);
    exit(); // Asegurar que se detiene la ejecución
}

// Sidebar
include_once __DIR__ . "/Include/DashHeader.php";
include_once __DIR__ . "/Include/DashSidebar.php";
?>

<!-- Contenido principal -->
<div class="content" id="content">
    <?php
    include_once __DIR__ . "/Include/DashNav.php";
    ?>

    <div class="container py-3" id="Vista">
        <?php
        if (!empty($data['vista'])) {
            include_once $data['vista'];
        } else {
            include_once __DIR__ . "Dashboard/index";
        }
        ?>
    </div>

</div>
<?php
include_once __DIR__ . "/Include/DashFooter.php";
?>