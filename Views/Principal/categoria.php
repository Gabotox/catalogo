<?php include_once "Views/Template-Principal/Header.php"; ?>

<!-- Filtros -->
<input type="hidden" id="categoria" data-idCategoria="<?php echo $data["id_categoria"]; ?>">

<div class="container-xl py-4">
    <div class="row">
        <div class="col-md-3">
            <h5>Filtrar por:</h5>

            <!-- Filtro por precio (moderno) -->

            <div class="row mt-5">
                <strong>
                    Precio
                </strong>
                <label for="priceMinCat" class="form-label">Desde</label>
                <input type="number" id="priceMinCat" class="form-control" placeholder="0" min="0">
                <span class="py-2"></span>
                <label for="priceMaxCat" class="form-label">Hasta</label>
                <input type="number" id="priceMaxCat" class="form-control" placeholder="1000" min="0">
            </div>

        </div>

        <!-- Productos -->
        <div class="col-md-9">
            <div class="row" id="categoriaContainer">
                <?php foreach ($data['categoria'] as $producto) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 product-itemCat"
                        data-precio="<?php echo $producto['precio_producto']; ?>">
                        <div class="card" style="margin: 1.5rem;">
                            <a href=" <?php echo BASE_URL . 'principal/detail/' . $producto['id_producto']; ?>" class="card-title">
                                <?php
                                $imagen = $producto['imagen_producto'];
                                $rutaImagen = filter_var($imagen, FILTER_VALIDATE_URL)
                                    ? $imagen  // Es una URL, úsala directamente
                                    : BASE_URL . 'assets/img/Productos/' . basename($imagen); // Es un archivo local
                                ?>
                                <img class="card-img-left" src="<?php echo htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>" alt="Imagen del Producto">
                            </a>
                            <div class="card-body mt-2">
                                <a href="<?php echo BASE_URL . 'Principal/detail/' . $producto['id_producto']; ?>" class="card-title" style="text-decoration: none;">
                                    <h5><?php echo $producto['nombre_producto']; ?></h5>
                                </a>
                                <p class="card-text"><?php echo $producto["descripcion_producto"]; ?></p>
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
                                        <?php echo htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>
                                        "
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
</div>


<?php include_once "Views/Template-Principal/Footer.php"; ?>

</body>

</html>