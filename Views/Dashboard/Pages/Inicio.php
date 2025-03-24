<div class="container">
    <h1 class="py-2">Dashboard</h1>

    <?php if ($data['productosStockBajo'] > 0) { ?>
        <div class="alert alert-danger d-flex align-items-center mt-3">
            <div>⚠ Hay <span class="badge bg-danger"><?php echo $data['productosStockBajo']; ?></span> productos con stock bajo.</div>
        </div>
    <?php } ?>
    <div class="row gap-2 gap-md-0">
        <!-- Tarjeta de Total de Productos -->
        <div class="col-md-6">
            <div class="card text-white bg-primary shadow-lg rounded-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total de Productos</h5>
                        <h2 class="fw-bold"><?php echo $data["totalProductos"]; ?></h2>
                    </div>
                    <i class="bi bi-box-seam display-4"></i>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Total de Categorías -->
        <div class="col-md-6">
            <div class="card text-white bg-success shadow-lg rounded-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total de Categorías</h5>
                        <h2 class="fw-bold"><?php echo $data["totalCategorias"]; ?></h2>
                    </div>
                    <i class="bi bi-tags display-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div class="mt-4">
    <h4 class="mb-5">Últimos Productos Agregados</h4>
    <div class="row">
        <?php foreach ($data['ultimosProductos'] as $producto) { ?>
            <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card shadow-sm border-0 rounded-3 text-center">
                    <img src="<?php echo $producto['imagen_producto']; ?>" class="card-img-top"
                        alt="Producto" style="height: 100px; object-fit: cover;">
                    <div class="card-body p-2">
                        <h6 class="card-title text-truncate" title="<?php echo $producto['nombre_producto']; ?>">
                            <?php echo $producto['nombre_producto']; ?>
                        </h6>
                        <p class="text-success fw-bold mb-1">
                            $<?php echo number_format($producto['precio_producto'], 0, ',', '.'); ?>
                        </p>

                        <a href="<?php echo BASE_URL ?>Dashboard/productos" class="btn btn-sm btn-outline-primary">Ver</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div> -->