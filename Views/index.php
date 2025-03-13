<?php
include_once "Views/Template-Principal/Header.php";
?>


<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_01.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Zay</b> eCommerce</h1>
                            <h3 class="h2">Tiny and Perfect eCommerce Template</h3>
                            <p>
                                Zay Shop is an eCommerce HTML5 CSS template with latest version of Bootstrap 5 (beta 1).
                                This template is 100% free provided by <a rel="sponsored" class="text-success" href="https://templatemo.com" target="_blank">TemplateMo</a> website.
                                Image credits go to <a rel="sponsored" class="text-success" href="https://stories.freepik.com/" target="_blank">Freepik Stories</a>,
                                <a rel="sponsored" class="text-success" href="https://unsplash.com/" target="_blank">Unsplash</a> and
                                <a rel="sponsored" class="text-success" href="https://icons8.com/" target="_blank">Icons 8</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_02.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Proident occaecat</h1>
                            <h3 class="h2">Aliquip ex ea commodo consequat</h3>
                            <p>
                                You are permitted to use this Zay CSS template for your commercial websites.
                                You are <strong>not permitted</strong> to re-distribute the template ZIP file in any kind of template collection websites.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_03.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Repr in voluptate</h1>
                            <h3 class="h2">Ullamco laboris nisi ut </h3>
                            <p>
                                We bring you 100% free CSS templates for your websites.
                                If you wish to support TemplateMo, please make a small contribution via PayPal or tell your friends about our website. Thank you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        <!-- 1era fila: Título de la sección -->
        <div class="col-lg-12 pb-3 d-flex justify-content-between align-items-center">
            <h1 class="h2 pb-3 mb-0">Categorías</h1>
            <!-- Icono de búsqueda -->
            <a class="nav-icon ms-auto d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                <i class="fa fa-fw fa-search text-dark mr-2"></i>
            </a>
        </div>
    </div>

    <div class="row">
        <!-- 2da fila: Categorías disponibles y select -->
        <div class="col-lg-12 d-flex justify-content-between align-items-center gap-2">
            <ul class="mb-0 col-lg-8 swiper mySwiper" id="swiper-botones">
                <!-- Botones de categorías  -->
                <div class="swiper-wrapper" id="botones">
                    <?php foreach ($data['categorias'] as $categoria) { ?>
                        <li class="swiper-slide">
                            <a class="text-dark text-decoration-none mr-3" href="<?php echo BASE_URL . 'principal/categoria/' . $categoria['id_categoria']; ?>">
                                <?php
                                echo $categoria['nombre_categoria'];
                                ?>
                            </a>
                        </li>
                    <?php } ?>
                </div>
            </ul>
            <div class="d-flex ms-auto col-lg-3 ">
                <select class="form-control">
                    <option>Featured</option>
                    <option>A to Z</option>
                    <option>Item</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row pt-5 gap-5">
        <?php
        // Agrupa los productos por categoría
        $productos_por_categoria = [];
        foreach ($data['productosConCategoria'] as $producto) {
            $categoria = $producto['nombre_categoria'];
            $id_categoria = $producto['categoria_id'];
            if (!isset($productos_por_categoria[$categoria])) {
                $productos_por_categoria[$categoria] = [];
            }
            $productos_por_categoria[$categoria][] = $producto;
        }
        ?>

        <!-- Itera sobre las categorías y sus productos -->
        <?php foreach ($productos_por_categoria as $categoria => $productos) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Título de la categoría -->
                    <div class="row d-flex justify-content-between align-items-center pb-4">
                        <div class="col-lg-9 text-start">
                            <h2 class="h3"><?php echo $categoria; ?></h2>
                        </div>
                        <div class="col-lg-2 text-end ms-auto">
                            <?php
                            // Usar el categoria_id del primer producto de la categoría
                            $categoria_id = $productos[0]['categoria_id'];
                            ?>
                            <a href="<?php echo BASE_URL . 'principal/categoria/' . $categoria_id; ?>" class="btn">Ver todo</a>
                        </div>
                    </div>

                    <!-- Productos de la categoría -->
                    <div class="swiper mySwiper" id="swiper-productos">
                        <div class="swiper-wrapper">
                            <?php foreach ($productos as $producto) { ?>
                                <div class="swiper-slide">
                                    <div class="card">
                                        <!-- Imagen del producto -->
                                        <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id_producto']; ?>" class="card-title">
                                            <img class="card-img-left" src="<?php echo $producto['imagen_producto']; ?>"
                                                alt="Imagen del Producto"
                                                data-imagen="<?php echo $producto['imagen_producto']; ?>" />
                                        </a>

                                        <div class="card-body mt-2">
                                            <!-- Nombre y Descripción -->
                                            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id_producto']; ?>"
                                                class="card-title"
                                                data-nombre="<?php echo $producto['nombre_producto']; ?>">
                                                <?php echo $producto['nombre_producto']; ?>
                                            </a>
                                            <p class="card-text"><?php echo $producto['descripcion_producto']; ?></p>

                                            <input type="hidden" value="1" class="cantidad">

                                            <!-- Precio y botón de agregar al carrito -->
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <a href="#" class="btn btn-add-to-cart d-flex align-items-center gap-2" id="btnAddCarrito"
                                                    prod="<?php echo $producto['id_producto']; ?>"
                                                    data-nombre="<?php echo $producto['nombre_producto']; ?>"
                                                    data-imagen="<?php echo $producto['imagen_producto']; ?>"
                                                    data-precio="<?php echo $producto['precio_producto']; ?>">
                                                    <i class="fa-solid fa-cart-shopping"></i> Agregar
                                                </a>

                                                <span class="price" data-precio="<?php echo $producto['precio_producto']; ?>">
                                                    $<?php echo $producto['precio_producto']; ?>
                                                </span>
                                            </div>
                                        </div>

                                        <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id_producto']; ?>" class="ojo">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        <?php } ?>
    </div>

</div>


<?php include_once "Views/Template-Principal/Footer.php"; ?>
</body>

</html>