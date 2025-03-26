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
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/General/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/Include/header.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/mod/carrito.css'; ?>">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/fontawesome.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/all.min.css'; ?>">

    <!-- SWIPER JS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/swiper-bundle.min.css">

    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/toastify.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/css/slick.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/css/slick-theme.css'; ?>">




</head>

<body>
    <div id="loader-container">
        <div class="loader"></div>
    </div>

    <div class="bg-success py-2 fixed-bottom ente d-flex gap-3 align-items-center justify-content-center text-white" id="countdownContainer">
        <span>
            Bienvenido, este es el tiempo que tienes para realizar tu orden con envío gratis:
        </span>
        <span id="countdown" class="text-center mb-0">

        </span>
        <script>
            // Set the date we're counting down to
            var countDownDate = new Date(new Date().getTime() + 1 * 60 * 60 * 1000).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="countdown"
                document.getElementById("countdown").innerHTML = hours + "h " +
                    minutes + "m " + seconds + "s ";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>


        <span id="entender" style="border: 2px solid #fff; padding: .5rem 1rem; border-radius: 1rem; cursor: pointer;">
            Entendido
        </span>

        <script>
            document.getElementById("entender").addEventListener("click", function() {
                document.getElementById("countdownContainer").classList.add("d-none");
            });
        </script>
    </div>


    <!-- Header -->
    <marquee behavior="scroll" direction="left" class="d-flex align-items-center" style="font-weight:bold; background: #6ded8e; position:sticky; top: 0; height:30px; z-index: 1050;" scrollamount="10" loop="infinite">
        <span style="margin-right: 8rem;">Horarios de pedido</span>
        <span style="margin-right: 8rem;">Servicio a domicilio</span>
        <span style="margin-right: 8rem;">De lunes a viernes de 8:00 a.m. a 8:00 p.m.</span>
        <span style="margin-right: 8rem;">Sábados y domingos de 8:00 a.m. a 6:00 p.m.</span>
    </marquee>



    <nav class="navbar navbar-expand-lg navbar-light shadow" style="position: sticky; top: 30px; z-index: 1040; background-color: #f8f9fa;">
        <div class="container d-flex justify-content-between align-items-center w-100">
            <!-- Logo -->
            <a class="navbar-brand text-success logo h1" href="<?php echo BASE_URL; ?>">
                <img src="<?php echo BASE_URL ?>assets/img/logo.jfif" alt="Logo" width="50">
            </a>

            <!-- Toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <!-- Barra de búsqueda centrada -->
                <div class="search-bar flex-grow-1 d-flex justify-content-center my-2 my-lg-0">
                    <div class="cont-bus w-75">
                        <form class="d-flex contenedor-busqueda" role="search">
                            <input class="form-control me-2 searchInput" type="search" placeholder="Buscar..." aria-label="Search">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <div class="resultadosBusqueda w-75"></div>
                </div>

                <!-- Iconos del carrito y usuario -->
                <div class="d-flex align-items-center justify-content-center gap-3 mt-3 mt-lg-0" style="margin-top: 2rem !important; margin-bottom: 1rem !important;">
                    <!-- Icono del carrito -->
                    <button class="nav-icon position-relative text-decoration-none bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#carritoModal">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark" id="btnCantidadCarrito">0</span>
                    </button>

                    <!-- Icono del usuario -->
                    <a class="nav-icon position-relative text-decoration-none" href="<?php echo BASE_URL . 'Admin/login/'; ?>">
                        <i class="fa fa-fw fa-user text-dark"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Header -->


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