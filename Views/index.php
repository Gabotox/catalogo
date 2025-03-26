<?php
include_once "Views/Template-Principal/Header.php";
?>

<style>
    #swiperBanner img {
        width: 100% !important;
    }
</style>

<!-- INICIO DE BANNER -->
<div class="swiper mySwiper" id="swiperBanner">
    <div class="swiper-wrapper">
        <div class="swiper-slide active">
            <div class="row" style="position: relative; height: 100%;">
                <img class="" src="<?php echo BASE_URL; ?>assets/img/Banners/papas.jpg" alt="Papas frescas" style="filter: brightness(0.5);">
                <div style="z-index: 1; padding: 1rem; padding-left: 3rem; position: absolute; top:0; bottom: 0; margin:auto; color: white; width: max-content; display: flex; flex-direction: column; justify-content: center;">
                    <h2 style="margin-bottom: 1rem;">
                        ¡Las mejores papas!
                    </h2>
                    <p style="margin-bottom: 1rem;">Crujientes, frescas y llenas de sabor. ¡Perfectas para cualquier receta!</p>
                    <button class="button-92 d-flex gap-2 align-items-center" role="button"><i class="fa-solid fa-cart-shopping"></i>Compra ya</button>
                </div>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="row" style="position: relative; height: 100%;">
                <img class="" src="<?php echo BASE_URL; ?>assets/img/Banners/paa.jpg" alt="Frutas tropicales" style="filter: brightness(0.5);">
                <div style="z-index: 1; padding: 1rem; padding-right: 3rem; position: absolute; top:0; bottom: 0; margin:auto; color: white; width: max-content; display: flex; flex-direction: column; justify-content: center; right: 0; text-align: right;">
                    <h2 style="margin-bottom: 1rem;">
                        Sabor tropical
                    </h2>
                    <p style="margin-bottom: 1rem;">Prueba nuestras frutas frescas, jugosas y llenas de vitaminas.</p>
                    <button class="button-92 d-flex gap-2 align-items-center ms-auto" role="button"><i class="fa-solid fa-cart-shopping"></i>Compra ya</button>
                </div>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="row" style="position: relative; height: 100%;">
                <img class="" src="<?php echo BASE_URL; ?>assets/img/Banners/Verduras.jpg" alt="Verduras frescas" style="filter: brightness(0.5);">
                <div style="z-index: 1; padding: 1rem; padding-left: 3rem; position: absolute; top:0; bottom: 0; margin:auto; color: white; width: max-content; display: flex; flex-direction: column; justify-content: center;">
                    <h2 style="margin-bottom: 1rem;">
                        Frescura y salud
                    </h2>
                    <p style="margin-bottom: 1rem;">Verduras recién cosechadas para tus comidas más saludables.</p>
                    <!-- HTML !-->
                    <button class="button-92 d-flex gap-2 align-items-center" role="button"><i class="fa-solid fa-cart-shopping"></i>Compra ya</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- 
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
</div> -->
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
    <div class="row py-5 pb-2">
        <!-- 2da fila: Categorías disponibles y select -->
        <div class="col-lg-12 d-flex justify-content-between align-items-center gap-2">
            <!-- Swiper -->
            <div class="swiper mySwiper" id="swiper-categorias">
                <div class="swiper-wrapper">
                    <?php foreach ($data['categorias'] as $categoria) { ?>
                        <div class="swiper-slide">
                            <div class="card text-center mb-3">
                                <a href="<?php echo BASE_URL . 'principal/categoria/' . $categoria['id_categoria']; ?>" class="aaaa">
                                    <div class="categoria-imagen">
                                        <img src="<?php echo BASE_URL; ?>assets/img/Categorias/ver.png" class="card-img-top" alt="<?php echo $categoria['nombre_categoria']; ?>">
                                    </div>
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
    </div>
</div>


<div id="bannerVideo">
    <div class="row" style="position: relative;">
        <video autoplay muted loop style="filter: brightness(0.5);">
            <source src="<?php echo BASE_URL; ?>assets/img/Banners/campeee.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div style="z-index: 1; padding: 1rem; padding-left: 3rem; position: absolute; top:0; bottom: 0; margin:auto; color: white; width: max-content; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-bottom: 1rem;">
                PRODUCTOS 100% COLOMBIANOS
            </h2>
            <p style="margin-bottom: 1rem;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor, impedit?</p>
            <h2><a class="" style="border: 2px solid #fff; text-decoration: none; padding: 1rem; border-radius: 10px; color: #fff;" href="#">Comprar ahora</a></h2>
        </div>
    </div>
</div>


<div class="container">
    <!-- TARJETAS DE  PRODUCTOS -->
    <div class="py-5 pb-2 d-flex justify-content-between align-items-center">
        <h2>
            Nuestros productos
        </h2>

        <a href="<?php echo BASE_URL; ?>principal/productos/" class="btn btn-sm bg-success text-white p-2"
            style="text-decoration: none;">Ver todos</a>
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
                                <?php
                                $imagen = $producto['imagen_producto'];
                                $rutaImagen = filter_var($imagen, FILTER_VALIDATE_URL)
                                    ? $imagen  // Es una URL, úsala directamente
                                    : BASE_URL . 'assets/img/Productos/' . basename($imagen); // Es un archivo local
                                ?>
                                <img class="card-img-left" src="<?php echo htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>" alt="Imagen del Producto">
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
                                        data-imagen="
                                        <?php
                                        $imagen = $producto['imagen_producto'];
                                        $rutaImagen = filter_var($imagen, FILTER_VALIDATE_URL)
                                            ? $imagen  // Es una URL, úsala directamente
                                            : BASE_URL . 'assets/img/Productos/' . basename($imagen); // Es un archivo local
                                        ?>
                                        <?php echo htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>"
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
</div>


<div class="container">
    <!-- BANNER DE PRODUCTOS 2 -->
    <div class="row py-5 pb-2">
        <h2>
            Titulo
        </h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nam aliquam consequuntur delectus, deserunt aut harum tenetur temporibus quibusdam maiores?</p>
    </div>
    <div class="row">
        <!-- Tarjeta principal grande -->
        <div class="col-lg-8">
            <div class="card">
                <img class="" src="<?php echo BASE_URL; ?>assets/img/Banners/paa.jpg" alt="Banner 1" style="border-radius: 1rem; filter: brightness(0.5);">
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
                        <img class="" src="<?php echo BASE_URL; ?>assets/img/Banners/papas.jpg" alt="Banner 1" style="border-radius: 1rem; filter: brightness(0.5);">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                            <h5 class="text-white text-center">PRÓXIMAMENTE EN NUESTRA TIENDA</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <img class="" src="<?php echo BASE_URL; ?>assets/img/Banners/verduras.jpg" alt="Banner 1" style="border-radius: 1rem; filter: brightness(0.5);">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DE BANNER DE PRODUCTOS 2 -->
</div>




<div class="container pb-5">
    <!-- OPINIONES CLIENTES -->
    <div class="row py-5 pb-2">
        <h2>Opiniones de clientes</h2>
    </div>
    <div class="row">
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
        </div>
    </div>

</div>
<!-- FINAL DE CONTENIDO -->


<?php include_once "Views/Template-Principal/Footer.php"; ?>