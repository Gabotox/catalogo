<?php include_once "Views/Template-Principal/Header.php"; ?>

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="row carta mb-3">
                    <img class="card-img img-fluid" src="<?php echo $data['producto']['imagen_producto']; ?>" alt="Card image cap" id="imagenProducto">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5 ">
                <div class="card p-5">
                    <div class="card-body">
                        <h1 class="h2" id="nombreProducto"><?php echo $data['producto']['nombre_producto']; ?></h1>
                        <p class="h3 py-2" id="precioProducto"><?php echo '' . MONEDA . ' $' . $data['producto']['precio_producto']; ?></p>

                        <h6>Categoria:</h6>
                        <a href="<?php echo BASE_URL . 'principal/categoria/' . $data['producto']['categoria_id']; ?>"
                            class="text-decoration-none text-dark">
                            <?php echo $data['producto']['nombre_categoria']; ?>
                        </a>

                        <h6 class="mt-3">Description:</h6>
                        <p><?php echo $data['producto']['descripcion_producto']; ?></p>

                        <form action="" method="GET">
                            <input type="hidden" id="idProducto" value="<?php echo $data['producto']['id_producto']; ?>">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Cantidad
                                            <input type="hidden" id="cantidad" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="button" class="btn btn-success btn-lg" id="btnAgregarCarrito" prod="<?php echo $data['producto']['id_producto']; ?>">Add To Cart</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->

<!-- Start Article -->
<section class="py-5">
    <div class="container">
        <div class="row text-left p-2 pb-3">
            <h4>Productos relacionados</h4>
        </div>

        <!--Start Carousel Wrapper-->

        <div class="swiper mySwiper" id="swiper-productos">
            <div class="swiper-wrapper">
                <?php foreach ($data['relacionados'] as $relacionado) {
                    if ($data['producto']['id_producto'] != $relacionado['id_producto']) {
                ?>
                        <div class="swiper-slide">
                            <div class="card">
                                <!-- Imagen del producto -->
                                <a href="<?php echo BASE_URL . 'principal/detail/' . $relacionado['id_producto']; ?>" class="card-title">
                                    <?php
                                    $imagen = $relacionado['imagen_producto'];
                                    $rutaImagen = filter_var($imagen, FILTER_VALIDATE_URL)
                                        ? $imagen  // Es una URL, úsala directamente
                                        : BASE_URL . 'assets/img/Productos/' . basename($imagen); // Es un archivo local
                                    ?>
                                    <img class="card-img-left" src="<?php echo htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>" alt="Imagen del Producto">
                                    <div class="card-body mt-2">
                                        <!-- Nombre y Descripción -->
                                        <a href="<?php echo BASE_URL . 'principal/detail/' . $relacionado['id_producto']; ?>" class="card-title"><?php echo $relacionado['nombre_producto']; ?></a>
                                        <p class="card-text"><?php echo $relacionado['descripcion_producto']; ?></p>

                                        <!-- Precio y botón de agregar al carrito -->
                                        <div class="d-flex justify-content-between align-items-center mt-2 btnAddCarrito">
                                            <a href="#" class="btn btn-add-to-cart d-flex align-items-center gap-2">
                                                <i class="fa-solid fa-bag-shopping"></i> Agregar
                                            </a>

                                            <span class="price">$ <?php echo $relacionado['precio_producto']; ?></span>
                                        </div>
                                    </div>

                                    <a href="<?php echo BASE_URL . 'principal/detail/' . $relacionado['id_producto']; ?>" class="ojo">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>


    </div>
</section>
<!-- End Article -->

<?php include_once "Views/Template-Principal/Footer.php"; ?>


<!-- Start Slider Script -->
<script src="<?php echo BASE_URL; ?>assets/js/slick.min.js"></script>

</body>

</html>