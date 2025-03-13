<?php include_once "Views/Template-Principal/Header.php"; ?>

<!-- Productos de la categoría -->
<div class="container py-5">
    <h2 class="mb-5 mt-3">Productos de la categoría <small class="text-danger"><?php echo $data['categoria'][0]['nombre_categoria']; ?></small></h2>
    <div class="row pt-3 gap-5 d-flex justify-content-center">

        <?php foreach ($data['categoria'] as $producto) { ?>
            <div class="col-md-3">
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
                                $ <?php echo $producto['precio_producto']; ?>
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



<?php include_once "Views/Template-Principal/Footer.php"; ?>