<?php
include_once "Views/Template-Principal/Header.php";
?>

<!-- INICIO DE BANNER -->
<div class="swiper mySwiper" id="swiperBanner">
    <div class="swiper-wrapper">
        <?php foreach ($data['banners'] as $index => $banner) { ?>
            <div class="swiper-slide <?php echo $index === 0 ? 'active' : ''; ?>">
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
        <?php } ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<!-- FINAL DE BANNER -->


<!-- INICIO DE CONTENIDO -->
<div class="container py-5">

    <!-- CATEGORIAS DISPONIBLES -->
    <div class="row">
        <!-- 1era fila: Título de la sección -->
        <div class="col-lg-12 pb-3 d-flex justify-content-between align-items-center">
            <h2 class="pb-3 mb-0">Categorías</h1>
        </div>
    </div>
    <div class="row">
        <!-- 2da fila: Categorías disponibles y select -->
        <div class="col-lg-12 d-flex justify-content-between align-items-center gap-2">
            <div class="row">
                <?php foreach ($data['categorias'] as $categoria) { ?>
                    <div class="col-lg-2 mb-3 d-flex">
                        <div class="card w-100">
                            <a href="<?php echo BASE_URL . 'principal/categoria/' . $categoria['id_categoria']; ?>">
                                <img src="https://www.retailactual.com/media/uploads/noticias/productos-sabor-2018.jpg" class="card-img-top" alt="<?php echo $categoria['nombre_categoria']; ?>" height="150">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $categoria['nombre_categoria']; ?></h5>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- FIN DE CATEGORIAS DISPONIBLES -->


    <!-- BANNER DE PRODUCTOS 2 -->
    <div class="row py-5">
        <h2>
            Titulo
        </h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nam aliquam consequuntur delectus, deserunt aut harum tenetur temporibus quibusdam maiores?</p>
    </div>
    <div class="row">
        <!-- Tarjeta principal grande -->
        <div class="col-lg-8">
            <div class="card">
                <img src="https://www.retailactual.com/media/uploads/noticias/productos-sabor-2018.jpg" class="card-img-top" alt="Brinda con Like">
                <div class="card-img-overlay d-flex align-items-end">
                    <a href="URL_COMPRA" class="btn btn-dark btn-lg">COMPRAR AHORA</a>
                </div>
            </div>
        </div>
        <!-- Tarjetas laterales pequeñas -->
        <div class="col-lg-4">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card">
                        <img src="https://www.retailactual.com/media/uploads/noticias/productos-sabor-2018.jpg" class="card-img-top" alt="Próximamente">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                            <h5 class="text-white text-center">PRÓXIMAMENTE EN NUESTRA TIENDA</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <img src="https://www.retailactual.com/media/uploads/noticias/productos-sabor-2018.jpg" class="card-img-top" alt="Ver snacks">
                        <div class="card-img-overlay d-flex align-items-end">
                            <a href="URL_SNACKS" class="btn btn-dark">VER SNACKS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DE BANNER DE PRODUCTOS 2 -->



    <!-- TARJETAS DE  PRODUCTOS -->
    <div class="row py-5">
        <h2>
            Nuestros productos
        </h2>
    </div>
    <div class="row">
        <div class="swiper mySwiper" id="swiper-productos">
            <div class="swiper-wrapper">
                <?php
                // Obtener 20 productos aleatorios
                $productos_random = $data['productosConCategoria'];
                shuffle($productos_random);
                $productos_random = array_slice($productos_random, 0, 20);
                ?>

                <?php foreach ($productos_random as $producto) { ?>
                    <div class="swiper-slide">
                        <div class="card">
                            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id_producto']; ?>" class="card-title">
                                <img class="card-img-left" src="<?php echo $producto['imagen_producto']; ?>" alt="Imagen del Producto">
                            </a>
                            <div class="card-body mt-2">
                                <a href="<?php echo BASE_URL . 'Principal/detail/' . $producto['id_producto']; ?>" class="card-title">
                                    <h5><?php echo $producto['nombre_producto']; ?></h5>
                                </a>
                                <p class="card-text">$<?php echo $producto['precio_producto']; ?></p>
                                <input type="hidden" value="1" class="cantidad">
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <a href="#" class="btn btn-add-to-cart d-flex align-items-center gap-2" id="btnAddCarrito"
                                        prod="<?php echo $producto['id_producto']; ?>"
                                        data-nombre="<?php echo $producto['nombre_producto']; ?>"
                                        data-imagen="<?php echo $producto['imagen_producto']; ?>"
                                        data-precio="<?php echo $producto['precio_producto']; ?>">
                                        <i class="fa-solid fa-cart-shopping"></i> Agregar
                                    </a>
                                    <span class="price">$<?php echo $producto['precio_producto']; ?></span>
                                </div>
                            </div>
                            <a href="<?php echo BASE_URL . 'Principal/detail/' . $producto['id_producto']; ?>" class="ojo">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
    <!-- FIN DE TARJETAS DE PRODUCTOS -->



    <!-- OPINIONES CLIENTES -->
    <div class="row pt-5">
        <h2>Opiniones de clientes</h2>
    </div>
    <div class="row py-5">
        <div class="swiper mySwiper" id="swiper-opiniones">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="row">
                        <p class="comentario px-4 py-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis perspiciatis veritatis hic, ipsam esse eligendi.
                        </p>

                        <div class="d-flex mt-3 gap-3 align-items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5gv6VVdtAGLqBK9MXIBOUGJ-hWeVdiiN-3Q&s" alt="" width="60" height="60">
                            <div id="come">
                                <p class="nombre">Nombre Usuario</p>
                                <div class="d-flex" style="margin: 0; padding: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <p class="comentario px-4 py-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis perspiciatis veritatis hic, ipsam esse eligendi.
                        </p>

                        <div class="d-flex mt-3 gap-3 align-items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5gv6VVdtAGLqBK9MXIBOUGJ-hWeVdiiN-3Q&s" alt="" width="60" height="60">
                            <div id="come">
                                <p class="nombre">Nombre Usuario</p>
                                <div class="d-flex" style="margin: 0; padding: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <p class="comentario px-4 py-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis perspiciatis veritatis hic, ipsam esse eligendi.
                        </p>

                        <div class="d-flex mt-3 gap-3 align-items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5gv6VVdtAGLqBK9MXIBOUGJ-hWeVdiiN-3Q&s" alt="" width="60" height="60">
                            <div id="come">
                                <p class="nombre">Nombre Usuario</p>
                                <div class="d-flex" style="margin: 0; padding: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <p class="comentario px-4 py-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis perspiciatis veritatis hic, ipsam esse eligendi.
                        </p>

                        <div class="d-flex mt-3 gap-3 align-items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5gv6VVdtAGLqBK9MXIBOUGJ-hWeVdiiN-3Q&s" alt="" width="60" height="60">
                            <div id="come">
                                <p class="nombre">Nombre Usuario</p>
                                <div class="d-flex" style="margin: 0; padding: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <p class="comentario px-4 py-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis perspiciatis veritatis hic, ipsam esse eligendi.
                        </p>

                        <div class="d-flex mt-3 gap-3 align-items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5gv6VVdtAGLqBK9MXIBOUGJ-hWeVdiiN-3Q&s" alt="" width="60" height="60">
                            <div id="come">
                                <p class="nombre">Nombre Usuario</p>
                                <div class="d-flex" style="margin: 0; padding: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <p class="comentario px-4 py-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis perspiciatis veritatis hic, ipsam esse eligendi.
                        </p>

                        <div class="d-flex mt-3 gap-3 align-items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5gv6VVdtAGLqBK9MXIBOUGJ-hWeVdiiN-3Q&s" alt="" width="60" height="60">
                            <div id="come">
                                <p class="nombre">Nombre Usuario</p>
                                <div class="d-flex" style="margin: 0; padding: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row">
                        <p class="comentario px-4 py-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis perspiciatis veritatis hic, ipsam esse eligendi.
                        </p>

                        <div class="d-flex mt-3 gap-3 align-items-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5gv6VVdtAGLqBK9MXIBOUGJ-hWeVdiiN-3Q&s" alt="" width="60" height="60">
                            <div id="come">
                                <p class="nombre">Nombre Usuario</p>
                                <div class="d-flex" style="margin: 0; padding: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

</div>
<!-- FINAL DE CONTENIDO -->


<?php include_once "Views/Template-Principal/Footer.php"; ?>
</body>

</html>