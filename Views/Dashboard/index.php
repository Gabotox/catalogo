<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . "/Include/DashHeader.php";

error_log("Usuario en sesión: " . ($_SESSION['usuario_nombre'] ?? "No hay sesión"));

if (!isset($_SESSION['usuario_nombre'])) {
    header("Location: " . BASE_URL . "Admin/login");
    exit();
}

// Sidebar
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

    
    <?php
    include_once __DIR__ . "/Include/DashFooter.php";
    ?>