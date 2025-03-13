<?php include_once "Views/Template-Principal/Header.php"; ?>

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="row carta mb-3">
                    <img class="card-img img-fluid" src="<?php echo $data['producto']['imagen_producto']; ?>" alt="Card image cap" id="imagenProducto">
                </div>
                <div class="row">
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </div>
                    <!--End Controls-->
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_01.jpg" alt="Product Image 1">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_02.jpg" alt="Product Image 2">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_03.jpg" alt="Product Image 3">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.First slide-->

                            <!--Second slide-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_04.jpg" alt="Product Image 4">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_05.jpg" alt="Product Image 5">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_06.jpg" alt="Product Image 6">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.Second slide-->

                            <!--Third slide-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_07.jpg" alt="Product Image 7">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_08.jpg" alt="Product Image 8">
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid" src="<?php echo BASE_URL; ?>assets/img/product_single_09.jpg" alt="Product Image 9">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/.Third slide-->
                        </div>
                        <!--End Slides-->
                    </div>
                    <!--End Carousel Wrapper-->
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!--End Controls-->
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
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                </div>
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
                                    <img class="card-img-left" src="<?php echo $relacionado['imagen_producto'] ?>" alt="Imagen del Producto" /></a>

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
<script>
    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        dots: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            }
        ]
    });
</script>
<!-- End Slider Script -->

</body>

</html>