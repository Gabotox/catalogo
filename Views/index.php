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
        <?php foreach ($data['banners'] as $index => $banner) { ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?php echo $banner['imagen_banner']; ?>" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><?php echo $banner['titulo_banner']; ?></h1>
                                <h3 class="h2"><?php echo $banner['titulo_banner']; ?></h3>
                                <p>
                                    <?php echo $banner['descripcion_banner']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }   ?>
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
            if (!isset($productos_por_categoria[$categoria])) {
                $productos_por_categoria[$categoria] = [];
            }
            $productos_por_categoria[$categoria][] = $producto;
        }

        // Tomar solo las primeras 4 categorías
        $categorias_mostradas = array_slice($productos_por_categoria, 0, 4, true);
        ?>

        <!-- Itera sobre las categorías y sus productos -->
        <?php foreach ($categorias_mostradas as $categoria => $productos) { ?>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <!-- Título de la categoría -->
                    <div class="row d-flex justify-content-between align-items-center pb-4">
                        <div class="col-lg-9 text-start">
                            <h2 class="h3"><?php echo $categoria; ?></h2>
                        </div>
                        <div class="col-lg-2 text-end ms-auto">
                            <a href="<?php echo BASE_URL . 'principal/categoria/' . $productos[0]['categoria_id']; ?>" class="btn bg-success text-white">Ver todo</a>
                        </div>
                    </div>

                    <!-- Productos de la categoría -->
                    <div class="swiper mySwiper" id="swiper-productos">
                        <div class="swiper-wrapper">
                            <?php
                            // Mostrar solo los primeros 5 productos de cada categoría
                            $productos_limitados = array_slice($productos, 0, 5);
                            foreach ($productos_limitados as $producto) { ?>
                                <div class="swiper-slide">
                                    <div class="card">
                                        <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id_producto']; ?>" class="card-title">
                                            <img class="card-img-left" src="<?php echo $producto['imagen_producto']; ?>" alt="Imagen del Producto">
                                        </a>
                                        <div class="card-body mt-2">
                                            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id_producto']; ?>" class="card-title">
                                                <?php echo $producto['nombre_producto']; ?>
                                            </a>
                                            <p class="card-text"><?php echo $producto['descripcion_producto']; ?></p>
                                            <input type="hidden" value="1" class="cantidad">
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <a href="#" class="btn btn-add-to-cart d-flex align-items-center gap-2"
                                                    prod="<?php echo $producto['id_producto']; ?>"
                                                    data-nombre="<?php echo $producto['nombre_producto']; ?>"
                                                    data-imagen="<?php echo $producto['imagen_producto']; ?>"
                                                    data-precio="<?php echo $producto['precio_producto']; ?>">
                                                    <i class="fa-solid fa-cart-shopping"></i> Agregar
                                                </a>
                                                <span class="price">$<?php echo $producto['precio_producto']; ?></span>
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

        <!-- Botón Ver Todas las Categorías -->
        <div class="mt-3">
            <a href="<?php echo BASE_URL . 'principal/categorias'; ?>" class="btn btn-success">Ver todas las categorías</a>
        </div>
    </div>



</div>


<?php include_once "Views/Template-Principal/Footer.php"; ?>
</body>

</html>