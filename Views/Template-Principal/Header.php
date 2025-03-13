<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo TITLE . ' - ' . $data['title']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo BASE_URL . 'assets/img/apple-icon.png'; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL . 'assets/img/favicon.ico'; ?>">

    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/templatemo.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/custom.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/style.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/mod/carrito.css'; ?>">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/fontawesome.min.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SWIPER JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/css/slick.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/css/slick-theme.css'; ?>">




</head>

<body>
    <div id="loader-container">
        <div class="loader"></div>
    </div>



    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- Logo -->
            <a class="navbar-brand text-success logo h1 align-self-center" href="<?php echo BASE_URL; ?>">
                <img src="<?php echo BASE_URL ?>assets/img/logo.jfif" alt="" width="50">
                Chaparro
            </a>

            <!-- Botón de toggle para dispositivos móviles -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenedor de los iconos -->
            <div class="collapse navbar-collapse" id="templatemo_main_nav">
                <div class="navbar-nav ms-auto d-flex align-items-center gap-3">
                    <!-- Barra de búsqueda para dispositivos móviles -->
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Icono de búsqueda -->
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <!-- Icono del carrito -->
                    <!-- Botón para abrir el modal del carrito -->
                    <button class="nav-icon position-relative text-decoration-none bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#carritoModal">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="btnCantidadCarrito">0</span>
                    </button>

                    <!-- Icono del usuario -->
                    <a class="nav-icon position-relative text-decoration-none" href="<?php echo BASE_URL . 'Admin/login/'; ?>">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal del carrito -->
    <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true" style="max-height: 90vh;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="carritoModalLabel">
                        <i class="fas fa-shopping-cart"></i> Mi Carrito
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <div id="contenidoCarrito">
                        <!-- Aquí se mostrarán los productos del carrito -->
                        <p class="text-center">El carrito está vacío.</p>
                    </div>
                </div>
                <!-- Pie del modal -->
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <h6 class="ms-3">Total a pagar: <span id="totalAPagar" class="badge bg-success" style="font-size: 1.2rem;">$0</span></h6>
                    <div class="btns d-flex gap-2 align-items-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <a href="<?php echo BASE_URL . 'clientes'; ?>" class="btn btn-success" id="btnPagar">
                            <i class="fas fa-credit-card"></i> Procesar pedido
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>