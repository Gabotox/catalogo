<div class="row d-flex justify-content-between align-items-center py-1">
    <div class="col-6">
        <h2 class="">Lista de Productos</h2>
    </div>
    <div class="col-6 d-flex justify-content-end gap-2">
        <button class="btn btn-success btn-sm btn-agregar"
            data-bs-toggle="modal" data-bs-target="#modalAgregar"><i class="fa-solid fa-plus"></i> Agregar Producto</button>
        <button class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria"><i class="fa-solid fa-layer-group"></i> Agregar Categoría</button>
    </div>
</div>
<div class="row py-3">
    <form class="d-flex col-md-6" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>

<div class="table-responsive"> <!-- Hace que la tabla sea desplazable en móviles -->
    <div class="cont-pro"> <!-- Aplica el scroll solo a la tabla -->
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark sticky-header border-0">
                <tr class="border-0">
                    <th class="border-0"><i class="fa-solid fa-image"></i> Imágen</th>
                    <th class="border-0"><i class="fa-solid fa-signature"></i> Nombre</th>
                    <th class="border-0"><i class="fa-solid fa-signature"></i> Descripción</th>
                    <th class="border-0"><i class="fa-solid fa-dollar-sign"></i> Precio</th>
                    <th class="border-0"><i class="fa-solid fa-cubes"></i> Disponible</th>
                    <th class="border-0"><i class="fa-solid fa-layer-group"></i> Categoría</th>
                    <th class="border-0"><i class="fa-solid fa-keyboard"></i> Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data['productos'] as $producto) { ?>
                    <tr>
                        <td class="align-middle"><img src="<?php echo $producto['imagen_producto']; ?>" alt="" width="50"></td>
                        <td class="align-middle"><?php echo $producto['nombre_producto']; ?></td>
                        <td class="align-middle"><?php echo $producto['descripcion_producto']; ?></td>
                        <td class="align-middle"><span class="badge bg-primary">$ <?php echo number_format($producto['precio_producto'], 0, ',', '.'); ?></span></td>
                        <td class="text-center align-middle"><span class="badge 
                            <?php
                            if ($producto['cantidad_producto'] >= 20) {
                                echo "bg-success";
                            } else if ($producto['cantidad_producto'] >= 10) {
                                echo "bg-warning";
                            } else {
                                echo "bg-danger";
                            }
                            ?>
                        "><?php echo $producto['cantidad_producto']; ?></span></td>
                        <td class="align-middle"><?php echo $producto['nombre_categoria']; ?></td>
                        <td class="align-middle text-nowrap">
                            <button class="btn btn-success btn-sm btn-ver"
                                data-bs-toggle="modal" data-bs-target="#modalVer"
                                data-id="<?php echo $producto['id_producto']; ?>"
                                data-imagen="<?php echo $producto['imagen_producto']; ?>"
                                data-nombre="<?php echo $producto['nombre_producto']; ?>"
                                data-precio="<?php echo number_format($producto['precio_producto'], 0, ',', '.'); ?>"
                                data-descripcion="<?php echo $producto['descripcion_producto']; ?>"
                                data-disponible="<?php echo $producto['cantidad_producto']; ?>"
                                data-categoria="<?php echo $producto['id_categoria']; ?>"
                                data-nombreCategoria="<?php echo $producto['nombre_categoria']; ?>">
                                <i class="fa-solid fa-eye"></i> Ver
                            </button>

                            <button class="btn btn-warning btn-sm btn-editar"
                                data-bs-toggle="modal" data-bs-target="#modalEditar"
                                data-id="<?php echo $producto['id_producto']; ?>"
                                data-nombre="<?php echo $producto['nombre_producto']; ?>"
                                data-precio="<?php echo $producto['precio_producto']; ?>"
                                data-descripcion="<?php echo $producto['descripcion_producto']; ?>"
                                data-disponible="<?php echo $producto['cantidad_producto']; ?>"
                                data-categoria="<?php echo $producto['id_categoria']; ?>">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </button>


                            <button class="btn btn-danger btn-sm btn-eliminar"
                                data-id="<?php echo $producto['id_producto']; ?>">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<nav aria-label="Page">
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


<!-- MODAL DE EDITAR -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarLabel">Editar producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-editar-producto">
                    <input type="hidden" id="editar-producto-id">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="editar-producto-nombre" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="editar-producto-nombre">
                        </div>
                        <div class="col-6">
                            <label for="editar-producto-precio" class="col-form-label">Precio:</label>
                            <input type="number" class="form-control" id="editar-producto-precio">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editar-producto-descripcion" class="col-form-label">Descripción:</label>
                        <textarea class="form-control" id="editar-producto-descripcion"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="editar-producto-disponible" class="col-form-label">Disponible:</label>
                            <input type="number" class="form-control" id="editar-producto-disponible">
                        </div>
                        <div class="col-6">
                            <label for="editar-producto-categoria" class="col-form-label">Categoría:</label>
                            <select class="form-select" id="editar-producto-categoria">
                                <option value="">-- Selecciona --</option>
                                <?php foreach ($data['categorias'] as $categoria) { ?>
                                    <option value="<?php echo $categoria['id_categoria']; ?>">
                                        <?php echo $categoria['nombre_categoria']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="editar">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE VER -->
<div class="modal fade" id="modalVer" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalVerLabel">Detalles del Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Columna 1: Imagen -->
                    <div class="col-md-5 text-center">
                        <img id="ver-producto-imagen" src="" alt="Imagen del Producto"
                            class="img-fluid rounded shadow" style="max-height: 300px;">
                    </div>

                    <!-- Columna 2: Datos -->
                    <div class="col-md-7 d-flex flex-column justify-content-center">
                        <p><strong>Nombre:</strong> <br> <span id="ver-producto-nombre"></span></p>
                        <p><strong>Precio:</strong><br> <span id="ver-producto-precio"></span></p>
                        <p><strong>Descripción:</strong><br> <span id="ver-producto-descripcion"></span></p>
                        <p><strong>Disponible:</strong><br> <span id="ver-producto-disponible"></span></p>
                        <p><strong>Categoría:</strong><br> <span id="ver-producto-categoria"></span></p>
                    </div>
                </div>
            </div>

            <!-- Botón de cierre -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE AGREGAR -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAgregarLabel">Agregar producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-agregar-producto">
                    <input type="hidden" id="agregar-producto-id">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="agregar-producto-nombre" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="agregar-producto-nombre">
                        </div>
                        <div class="col-6">
                            <label for="agregar-producto-precio" class="col-form-label">Precio:</label>
                            <input type="number" class="form-control" id="agregar-producto-precio">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="agregar-producto-descripcion" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="agregar-producto-descripcion"></textarea>
                        </div>
                        <div class="col-6">
                            <label for="agregar-producto-imagen" class="col-form-label">Imagen:</label>
                            <input type="text" class="form-control" id="agregar-producto-imagen">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="agregar-producto-disponible" class="col-form-label">Disponible:</label>
                            <input type="number" class="form-control" id="agregar-producto-disponible">
                        </div>
                        <div class="col-6">
                            <label for="agregar-producto-categoria" class="col-form-label">Categoría:</label>
                            <select class="form-select" id="agregar-producto-categoria">
                                <option value="">-- Selecciona --</option>
                                <?php foreach ($data['categorias'] as $categoria) { ?>
                                    <option value="<?php echo $categoria['id_categoria']; ?>">
                                        <?php echo $categoria['nombre_categoria']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="agregar">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

