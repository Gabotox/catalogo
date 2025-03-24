<?php
include_once __DIR__ . "/../../../Config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard <?php echo ' - ' . $data['title']; ?></title>


    <link rel="apple-touch-icon" href="<?php echo BASE_URL . 'assets/img/apple-icon.png'; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL . 'assets/img/favicon.ico'; ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/Dashboard/main.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

</head>

<body>

    <div id="loader-container">
        <div class="loader"></div>
    </div>



    <!-- MODAL DE AGREGAR PRODUCTO -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarLabel">Agregar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-agregar-producto" enctype="multipart/form-data">
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
                                <input type="file" class="form-control" id="agregar-producto-imagen" name="imagen">
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
                                    <?php foreach ($data['todasCategorias'] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_categoria']; ?>">
                                            <?php echo htmlspecialchars($categoria['nombre_categoria'], ENT_QUOTES, 'UTF-8'); ?>
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


    <!-- MODAL DE AGREGAR CATEGORIA -->
    <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarCategoriaLabel">Agregar categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-agregar-categoria" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="agregar-caregoria-nombre" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="agregar-categoria-nombre">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                            <label for="agregar-categoria-imagen" class="col-form-label">Imagen:</label>
                            <input type="file" class="form-control" id="agregar-categoria-imagen" name="imagen">
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="agregarCategoria">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>