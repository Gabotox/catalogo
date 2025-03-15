<div class="row d-flex justify-content-between align-items-center py-1">
    <div class="col-6">
        <h2 class="">Lista de Categorias</h2>
    </div>
    <div class="col-6 d-flex justify-content-end gap-2">
        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria"><i class="fa-solid fa-layer-group"></i> Agregar Categoría</button>
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
        <table class="table table-striped table-hover align-middle" id="categorias">
            <thead class="table-dark sticky-header border-0">
                <tr class="border-0">
                    <th class="border-0 w-75"><i class="fa-solid fa-signature"></i> Nombre</th>
                    <th class="border-0"><i class="fa-solid fa-keyboard"></i> Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data['categorias'] as $categoria) { ?>
                    <tr>
                        <td class="align-middle"><?php echo $categoria['nombre_categoria']; ?></td> <!-- Aplica el ancho a la celda -->
                        <td class="align-middle text-nowrap">
                            <button class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i> Ver</button>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Eliminar</button>
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