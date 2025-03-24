<div class="row d-flex justify-content-between align-items-center py-1">
    <div class="col-6">
        <h2 class="">Lista de Categorias</h2>
    </div>
    <div class="col-6 d-flex justify-content-end gap-2">
        <button class="btn btn-success btn-sm btn-agregar"
            data-bs-toggle="modal" data-bs-target="#modalAgregar"><i class="fa-solid fa-plus"></i> Agregar Producto</button>
        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria"><i class="fa-solid fa-layer-group"></i> Agregar Categoría</button>
    </div>
</div>

<div class="row py-3">
    <form class="col-md-6 position-relative col-6" role="search">
        <!-- Asegurar que este contenedor tenga el mismo ancho -->
        <div class="cont d-flex align-items-center w-100">
            <input id="searchInputCategorias" class="form-control flex-grow-1" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
            <div class="ic bg-success">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>

        <!-- Contenedor de resultados con el mismo ancho -->
        <div id="resultadosCategorias" class="search-results w-100"></div>

    </form>


</div>


<div class="table-responsive">
    <div class="cont-pro">
        <table class="table table-striped table-hover align-middle" id="categorias">
            <thead class="table-dark sticky-header border-0">
                <tr class="border-0">
                    <th class="border-0 text-center" style="width: 10%;"><i class="fa-solid fa-image"></i> Imágen</th>
                    <th class="border-0" style="width: 70%;"><i class="fa-solid fa-signature"></i> Nombre</th>
                    <th class="border-0" style="width: 20%;"><i class="fa-solid fa-keyboard"></i> Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data['categorias'] as $categoria) { ?>
                    <tr>
                        <td class="align-middle">
                            <?php
                            $imagen = $categoria['imagen_categoria'];
                            $rutaImagen = filter_var($imagen, FILTER_VALIDATE_URL)
                                ? $imagen  // Es una URL, úsala directamente
                                : BASE_URL . 'assets/img/Categorias/' . basename($imagen); // Es un archivo local
                            ?>
                            <img src="<?php echo htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>" alt="" width="50">
                        </td>
                        <td class="align-middle"><?php echo $categoria['nombre_categoria']; ?></td>
                        <td class="align-middle text-nowrap">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria"
                                data-id="<?php echo $categoria['id_categoria']; ?>"
                                data-nombre="<?php echo $categoria['nombre_categoria']; ?>"
                                data-imagen="<?php echo htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>">
                                <i class="fa-solid fa-pen-to-square"></i> Editar</button>

                            <button class="btn btn-danger btn-sm btn-eliminarCat" data-id="<?php echo $categoria['id_categoria']; ?>"><i class="fa-solid fa-trash"></i> Eliminar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>


<?php
$totalPaginas = isset($data['totalPaginas']) ? $data['totalPaginas'] : 1;
$paginaActual = isset($data['paginaActual']) ? $data['paginaActual'] : 1;
$paginaActual = max(1, min($paginaActual, $totalPaginas)); // Evita valores fuera de rango
$rango = 2; // Número de páginas visibles antes y después de la actual

if ($totalPaginas > 1) { // Solo mostrar si hay más de una página
?>
    <nav aria-label="Page">
        <ul class="pagination">
            <!-- Botón "Anterior" -->
            <?php if ($paginaActual > 1) { ?>
                <li class="page-item">
                    <a class="page-link text-black" href="?pagina=<?php echo $paginaActual - 1; ?>">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>
            <?php } ?>

            <!-- Primera página y puntos suspensivos -->
            <?php if ($paginaActual > 1 + $rango) { ?>
                <li class="page-item">
                    <a class="page-link text-black" href="?pagina=1">1</a>
                </li>
                <li class="page-item disabled"><span class="page-link text-black">...</span></li>
            <?php } ?>

            <!-- Páginas dentro del rango -->
            <?php for ($i = max(1, $paginaActual - $rango); $i <= min($totalPaginas, $paginaActual + $rango); $i++) { ?>
                <li class="page-item <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                    <a class="page-link text-black" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>

            <!-- Última página y puntos suspensivos -->
            <?php if ($paginaActual < $totalPaginas - $rango) { ?>
                <li class="page-item disabled"><span class="page-link text-black">...</span></li>
                <li class="page-item">
                    <a class="page-link text-black" href="?pagina=<?php echo $totalPaginas; ?>"><?php echo $totalPaginas; ?></a>
                </li>
            <?php } ?>

            <!-- Botón "Siguiente" -->
            <?php if ($paginaActual < $totalPaginas) { ?>
                <li class="page-item">
                    <a class="page-link text-black" href="?pagina=<?php echo $paginaActual + 1; ?>">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>



<!-- MODAL DE EDITAR -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarCategoriaLabel">Editar categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form-editar-categoria" enctype="multipart/form-data">
                    <input type="hidden" id="editar-categoria-id">
                    <div class="row mb-3">
                        <label for="editar-categoria-nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="editar-categoria-nombre">
                    </div>
                    <div class="row mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="editar-categoria-imagen" class="col-form-label">Imagen:</label>
                            <img id="editar-categoria-preview" src="" alt="Vista previa" class="img-fluid mb-2" style="max-height: 80px; max-width: 80px; object-fit: cover;">
                        </div>
                        <input type="file" class="form-control" id="editar-categoria-imagen" name="imagen">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="editarCategoria">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>