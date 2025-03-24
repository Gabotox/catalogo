<?php include_once "Views/Template-Principal/Header.php"; ?>


<div class="container py-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="py-4">Resumen de pedido</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center table-bordered table-striped table-hover align-middle" id="tableListaCarrito">
                            <thead>
                                <tr>
                                    <th>Imágen</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>SubTotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenará dinámicamente la lista de productos -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center gap-2 ">
                    <h3 style="font-size: 1.2rem;">Total a pagar: </h3>
                    <span class="fw-bold badge bg-success" id="totalProducto" style="font-size: 1.4rem;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1EH2eDt-yX9PU-UUMsxm2ob0kBw4S6oa0LA&s" alt="" class="img-thumbnail rounded-circle" width="150">
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de procesamiento de pedido -->
    <div class="row mt-3 mb-5" id="seccionPedido">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h3 class="card-title mb-4" style="font-size: 1.5rem;">Procesar Pedido</h3>
                    <form id="formularioPedido" class="row">
                        <div class="col-md-6 mb-4">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" placeholder="Ingresa tu teléfono" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" placeholder="Ingresa tu dirección" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="notas" class="form-label">Notas adicionales</label>
                            <textarea class="form-control" id="notas" rows="3" placeholder="Alguna nota adicional para tu pedido"></textarea>
                        </div>
                        <div class="text-center mt-4">
                            <div id="alertaCarritoVacio">

                            </div>
                            <a class="btn w-100 btn-danger" id="btnVolver" href="<?php echo BASE_URL;?>principal/productos/"></a>
                            <button type="submit" class="btn btn-success w-100" id="btnEnviarPedido">
                                <i class="fab fa-whatsapp"></i>
                                <span class="ms-1">Enviar Pedido por WhatsApp</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

</script>


<?php include_once "Views/Template-Principal/Footer.php"; ?>
<script src="<?php echo BASE_URL . 'assets/js/mod/Clientes.js'; ?>"></script>

</body>

</html>