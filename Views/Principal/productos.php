<?php include_once "Views/Template-Principal/Header.php"; ?>


<!-- Filtros -->
<div class="container-xl py-4">
    <div class="row">
        <div class="col-md-3">
            <h5>Filtrar por:</h5>

            <!-- Filtro por precio (moderno) -->

            <div class="row mt-5">
                <strong>
                    Precio
                </strong>
                <label for="priceMin" class="form-label">Desde</label>
                <input type="number" id="priceMin" class="form-control" placeholder="0" min="0">
                <span class="py-2"></span>
                <label for="priceMax" class="form-label">Hasta</label>
                <input type="number" id="priceMax" class="form-control" placeholder="1000" min="0">
            </div>

        </div>

        <!-- Contenedor de Productos -->
        <div class="col-md-9">
            <div class="row" id="productContainer">
                <?php

                $productosPorPagina = $data['productosPorPagina'] ?? 10; // Asigna un valor predeterminado de 10 si no está definido
                ?>
            </div>

            <div class="row mt-5 ms-auto" style="width:max-content;">
                <nav aria-label="Page" class="nav-productos">
                    <ul class="pagination">
                        <?php
                        $paginaActual = $data['paginaActual'];
                        $totalPaginas = $data['totalPaginas'];
                        $rango = 2; // Cuántas páginas mostrar antes y después de la actual

                        // Botón "Anterior"
                        if ($paginaActual > 1) { ?>
                            <li class="page-item">
                                <a class="page-link text-black" href="?pagina=<?php echo $paginaActual - 1; ?>"><i class="fa-solid fa-chevron-left"></i></a>
                            </li>
                        <?php }

                        // Botón "Primera página" (si no estamos en las primeras páginas)
                        if ($paginaActual > 1 + $rango) { ?>
                            <li class="page-item">
                                <a class="page-link text-black text-black" href="?pagina=1">1</a>
                            </li>
                            <li class="page-item disabled"><span class="page-link text-black">...</span></li>
                        <?php }

                        // Páginas anteriores
                        for ($i = max(1, $paginaActual - $rango); $i < $paginaActual; $i++) { ?>
                            <li class="page-item"><a class="page-link text-black" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php }

                        // Página actual (marcada como activa)
                        ?>
                        <li class="page-item active"><span class="page-link"><?php echo $paginaActual; ?></span></li>
                        <?php

                        // Páginas siguientes
                        for ($i = $paginaActual + 1; $i <= min($totalPaginas, $paginaActual + $rango); $i++) { ?>
                            <li class="page-item"><a class="page-link text-black" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php }

                        // Botón "Última página" (si aún estamos lejos de la última)
                        if ($paginaActual < $totalPaginas - $rango) { ?>
                            <li class="page-item disabled"><span class="page-link text-black">...</span></li>
                            <li class="page-item"><a class="page-link text-black" href="?pagina=<?php echo $totalPaginas; ?>"><?php echo $totalPaginas; ?></a></li>
                        <?php }

                        // Botón "Siguiente"
                        if ($paginaActual < $totalPaginas) { ?>
                            <li class="page-item">
                                <a class="page-link text-black" href="?pagina=<?php echo $paginaActual + 1; ?>"><i class="fa-solid fa-chevron-right"></i></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>





<?php include_once "Views/Template-Principal/Footer.php"; ?>

</body>

</html>