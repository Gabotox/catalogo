document.addEventListener("DOMContentLoaded", function () {

    // Verificar si el botón "editar" existe antes de asignarle un evento
    const btnEditar = document.getElementById("editar");


    if (btnEditar) {
        btnEditar.addEventListener("click", async function (event) {
            event.preventDefault(); // Evita el envío tradicional del formulario

            let nombre = document.getElementById("editar-producto-nombre").value;
            let precio = document.getElementById("editar-producto-precio").value;
            let descripcion = document.getElementById("editar-producto-descripcion").value;
            let disponible = document.getElementById("editar-producto-disponible").value;
            let categoria = document.getElementById("editar-producto-categoria").value;
            let imagenInput = document.getElementById("editar-producto-imagen");


            let nuevaImagen = imagenInput.files.length > 0 ? imagenInput.files[0].name : datosOriginalesProducto.imagen.split('/').pop();

            if (
                nombre === datosOriginalesProducto.nombre &&
                precio === datosOriginalesProducto.precio &&
                descripcion === datosOriginalesProducto.descripcion &&
                disponible === datosOriginalesProducto.disponible &&
                categoria === datosOriginalesProducto.categoria &&
                nuevaImagen === datosOriginalesProducto.imagen.split('/').pop() // Asegurar coincidencia exacta
            ) {
                Toastify({
                    text: "No has realizado ningún cambio.",
                    className: "info",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: "linear-gradient(to right, #ff9800, #ff5722)"
                    }
                }).showToast();
                return;
            }

            // Si los datos cambiaron, continuar con la petición
            let formData = new FormData();
            formData.append("id", document.getElementById("editar-producto-id").value);
            formData.append("nombre", nombre);
            formData.append("precio", precio);
            formData.append("descripcion", descripcion);
            formData.append("disponible", disponible);
            formData.append("categoria", categoria);

            if (imagenInput.files.length > 0) {
                formData.append("imagen", imagenInput.files[0]); // Adjuntar nueva imagen solo si el usuario selecciona una
            }




            try {
                const response = await fetch(base_url + "Dashboard/editar", {
                    method: "POST", // Cambia a POST porque PUT no soporta FormData
                    body: formData
                });

                const res = await response.json();

                Toastify({
                    text: res.message,
                    className: res.status === "success" ? "success" : "error",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: res.status === "success"
                            ? "linear-gradient(to right, #00b09b, #96c93d)"
                            : "linear-gradient(to right, #ff416c, #ff4b2b)"
                    }
                }).showToast();

                if (res.status === "success") {
                    setTimeout(() => {
                        window.location.href = base_url + "Dashboard/productos";
                    }, 2000);
                }
            } catch (error) {
                console.error("Error en la petición:", error);
            }
        });
    }



    // Evento para agregar un producto
    // Verificar si el botón "agregar" existe antes de asignarle un evento
    const btnAgregar = document.getElementById("agregar");

    if (btnAgregar) {
        btnAgregar.addEventListener("click", async function (event) {
            event.preventDefault();

            let formData = new FormData();
            formData.append("nombre", document.querySelector("#agregar-producto-nombre").value);
            formData.append("descripcion", document.querySelector("#agregar-producto-descripcion").value);
            formData.append("precio", document.querySelector("#agregar-producto-precio").value);
            formData.append("disponible", document.querySelector("#agregar-producto-disponible").value);
            formData.append("categoria", document.querySelector("#agregar-producto-categoria").value);


            // Obtener el archivo seleccionado
            let inputFile = document.querySelector("#agregar-producto-imagen");
            if (inputFile.files.length > 0) {
                formData.append("imagen", inputFile.files[0]); // Agregar el archivo
            }

            try {
                const response = await fetch(base_url + "Dashboard/agregar", {
                    method: "POST",
                    body: formData  // Importante: No usar JSON, sino FormData
                });

                const res = await response.json();

                Toastify({
                    text: res.message,
                    className: res.status === "success" ? "success" : "error",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: res.status === "success"
                            ? "linear-gradient(to right, #00b09b, #96c93d)"
                            : "linear-gradient(to right, #ff416c, #ff4b2b)"
                    }
                }).showToast();

                if (res.status === "success") {
                    console.log("Redirigiendo a productos...");
                    setTimeout(() => {
                        window.location.href = base_url + "Dashboard/productos";
                    }, 2000);
                }
            } catch (error) {
                console.error("Error en la petición:", error);
            }
        });
    }





    // Evento para eliminar un producto
    document.addEventListener("click", async function (event) {
        if (event.target.closest(".btn-eliminar")) {
            let boton = event.target.closest(".btn-eliminar");
            let id = boton.getAttribute("data-id");

            if (!confirm("¿Estás seguro de eliminar este producto?")) return;

            try {
                const response = await fetch(base_url + "Dashboard/eliminar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id_producto: id })
                });

                const res = await response.json();

                Toastify({
                    text: res.message,
                    className: res.status === "success" ? "success" : "error",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: res.status === "success"
                            ? "linear-gradient(to right, #00b09b, #96c93d)"
                            : "linear-gradient(to right, #ff416c, #ff4b2b)"
                    }
                }).showToast();

                if (res.status === "success") {
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            } catch (error) {
                console.error("Error en la petición:", error);
            }
        }
    });




    const agregarCategoriaBtn = document.getElementById("agregarCategoria");

    if (agregarCategoriaBtn) {
        agregarCategoriaBtn.addEventListener("click", async function (event) {
            event.preventDefault();

            let formData = new FormData();
            formData.append("nombre", document.querySelector("#agregar-categoria-nombre").value);
            // Obtener el archivo seleccionado
            let inputFile = document.querySelector("#agregar-categoria-imagen");
            if (inputFile.files.length > 0) {
                formData.append("imagen", inputFile.files[0]); // Agregar el archivo
            }

            try {
                const response = await fetch(base_url + "Dashboard/agregarCategoria", {
                    method: "POST",
                    body: formData  // Importante: No usar JSON, sino FormData
                });

                const res = await response.json();

                Toastify({
                    text: res.message,
                    className: res.status === "success" ? "success" : "error",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: res.status === "success"
                            ? "linear-gradient(to right, #00b09b, #96c93d)"
                            : "linear-gradient(to right, #ff416c, #ff4b2b)"
                    }
                }).showToast();

                if (res.status === "success") {
                    setTimeout(() => {
                        window.location.href = base_url + "Dashboard/categorias";
                    }, 2000);
                }
            } catch (error) {
                console.error("Error en la petición:", error);
            }
        });
    }





    // Verificar si el botón "editar" existe antes de asignarle un evento
    const btnEditarCategoria = document.getElementById("editarCategoria");

    if (btnEditarCategoria) {
        btnEditarCategoria.addEventListener("click", async function (event) {
            event.preventDefault(); // Evita el envío tradicional del formulario

            let nombre = document.getElementById("editar-categoria-nombre").value;
            let imagenInput = document.getElementById("editar-categoria-imagen");

            let nuevaImagen = imagenInput.files.length > 0 ? imagenInput.files[0].name : datosOriginalesCategoria.imagen.split('/').pop();

            if (
                nombre === datosOriginalesCategoria.nombre &&
                nuevaImagen === datosOriginalesCategoria.imagen.split('/').pop() // Asegurar coincidencia exacta
            ) {
                Toastify({
                    text: "No has realizado ningún cambio.",
                    className: "info",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: "linear-gradient(to right, #ff9800, #ff5722)"
                    }
                }).showToast();
                return;
            }

            let formData = new FormData();
            formData.append("id", document.getElementById("editar-categoria-id").value); // Asegurar que el ID se envía
            formData.append("nombre", nombre); 

            if (imagenInput.files.length > 0) {
                formData.append("imagen", imagenInput.files[0]); // Adjuntar nueva imagen solo si el usuario selecciona una
            }


            try {
                const response = await fetch(base_url + "Dashboard/editarCategoria", {
                    method: "POST", // Cambia a POST porque PUT no soporta FormData
                    body: formData
                });

                const res = await response.json();

                Toastify({
                    text: res.message,
                    className: res.status === "success" ? "success" : "error",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: res.status === "success"
                            ? "linear-gradient(to right, #00b09b, #96c93d)"
                            : "linear-gradient(to right, #ff416c, #ff4b2b)"
                    }
                }).showToast();

                if (res.status === "success") {
                    setTimeout(() => {
                        window.location.href = base_url + "Dashboard/categorias";
                    }, 2000);
                }
            } catch (error) {
                console.error("Error en la petición:", error);
            }
        });
    }



    document.addEventListener("click", async function (event) {
        if (event.target.closest(".btn-eliminarCat")) {
            let boton = event.target.closest(".btn-eliminarCat");
            let id = boton.getAttribute("data-id");

            if (!confirm("¿Estás seguro de eliminar esta categoría?")) return;

            try {
                const response = await fetch(base_url + "Dashboard/eliminarCategoria", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id_categoria: id })
                });

                const res = await response.json();

                Toastify({
                    text: res.message,
                    className: res.status === "success" ? "success" : "error",
                    duration: 2000,
                    gravity: "bottom",
                    position: "left",
                    style: {
                        background: res.status === "success"
                            ? "linear-gradient(to right, #00b09b, #96c93d)"
                            : "linear-gradient(to right, #ff416c, #ff4b2b)"
                    }
                }).showToast();

                if (res.status === "success") {
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            } catch (error) {
                console.error("Error en la petición:", error);
            }
        }
    });






    const searchInput = document.getElementById("searchInput");
    const resultadosContainer = document.getElementById("resultados");

    if (searchInput) {
        searchInput.addEventListener("input", async function () {
            let query = searchInput.value.trim();

            if (query.length === 0) {
                resultadosContainer.style.display = "none"; // 🔹 Oculta el contenedor si el input está vacío
                return;
            }

            if (query.length >= 2) {
                try {
                    const response = await fetch(base_url + "Dashboard/buscarProductos?q=" + encodeURIComponent(query));
                    const data = await response.json();

                    mostrarResultados(data);
                } catch (error) {
                    console.error("Error en la búsqueda:", error);
                    resultadosContainer.style.display = "none";
                }
            }
        });
    }

    function mostrarResultados(productos) {
        resultadosContainer.innerHTML = ""; // 🔹 Limpiar contenedor

        resultadosContainer.style.display = "block"; // 🔹 Mostrar el contenedor

        if (!productos || productos.length === 0) {
            resultadosContainer.innerHTML = `<div class="producto-item">No se encontraron productos</div>`;
            return;
        }

        productos.forEach(producto => {
            let precio = parseFloat(producto.precio_producto); // 🔹 Convertir a número
            let precioFormateado = isNaN(precio) ? "Precio no disponible" : precio.toFixed(0); // 🔹 Evitar errores

            let div = document.createElement("div");

            // Verifica si la imagen es una URL externa o una imagen almacenada localmente
            let imagenSrc = producto.imagen_producto.startsWith("http")
                ? producto.imagen_producto
                : `${base_url}assets/img/Productos/${producto.imagen_producto}`;



            div.classList.add("producto-item");
            div.innerHTML = `
                <div class="d-flex gap-4 align-items-center justify-content-between">
                    <div class="producto-detalles d-flex align-items-center gap-2">
                        <img src="${imagenSrc}" alt="${producto.nombre_producto}" class="img-thumbnail mr-3" style="width: 50px; height: 50px;">
                        <div class="producto-info d-flex gap-2">
                            <strong class="">
                                ${producto.nombre_producto}
                            </strong>
                            <p class="badge bg-primary mb-0">
                                $ ${precioFormateado}
                            </p>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-success btn-ver" 
                            data-bs-toggle="modal" data-bs-target="#modalVer"
                            data-id="${producto.id_producto}"
                            data-imagen="${imagenSrc}"
                            data-nombre="${producto.nombre_producto}"
                            data-precio="${producto.precio_producto}"
                            data-descripcion="${producto.descripcion_producto}"
                            data-disponible="${producto.cantidad_producto}"
                            data-categoria="${producto.id_categoria}"
                            data-nombreCategoria="${producto.nombre_categoria}">
                            Ver <i class="bi bi-eye"></i>
                        </button>

                        <button type="button" class="btn btn-sm btn-warning btn-editar"
                            data-bs-toggle="modal" data-bs-target="#modalEditar"
                            data-id="${producto.id_producto}"
                            data-nombre="${producto.nombre_producto}"
                            data-precio="${producto.precio_producto}"
                            data-descripcion="${producto.descripcion_producto}"
                            data-disponible="${producto.cantidad_producto}"
                            data-categoria="${producto.id_categoria}"
                            data-nombreCategoria="${producto.nombre_categoria}">
                            <i class="bi bi-pencil"></i> Editar 
                        </button>

                        <button type="button" class="btn btn-sm btn-danger btn-eliminar" data-id="${producto.id_producto}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>


                </div>
                `;

            resultadosContainer.appendChild(div);
        });
    }


    const searchInputCategorias = document.getElementById("searchInputCategorias");
    const resultadosContainerCategorias = document.getElementById("resultadosCategorias");

    if (searchInputCategorias) {
        searchInputCategorias.addEventListener("input", async function () {
            let query = searchInputCategorias.value.trim();

            if (query.length === 0) {
                resultadosContainerCategorias.style.display = "none"; // 🔹 Oculta el contenedor si el input está vacío
                return;
            }

            if (query.length >= 2) {
                try {
                    const response = await fetch(base_url + "Dashboard/buscarCategorias?q=" + encodeURIComponent(query));
                    const data = await response.json();

                    mostrarResultadosCategorias(data);
                } catch (error) {
                    console.error("Error en la búsqueda:", error);
                    resultadosContainerCategorias.style.display = "none";
                }
            }
        });
    }

    function mostrarResultadosCategorias(categorias) {
        resultadosContainerCategorias.innerHTML = ""; // 🔹 Limpiar contenedor

        resultadosContainerCategorias.style.display = "block"; // 🔹 Mostrar el contenedor

        if (!categorias || categorias.length === 0) {
            resultadosContainerCategorias.innerHTML = `<div class="producto-item">No se encontraron categorias</div>`;
            return;
        }


        categorias.forEach(categoria => {

            let div = document.createElement("div");

            // Verifica si la imagen es una URL externa o una imagen almacenada localmente
            let imagenSrc = categoria.imagen_categoria.startsWith("http")
                ? categoria.imagen_categoria
                : `${base_url}${categoria.imagen_categoria}`;


            div.classList.add("producto-item");
            div.innerHTML = `
                <div class="d-flex gap-4 align-items-center justify-content-between">
                    <div class="producto-detalles d-flex align-items-center gap-2">
                        <img src="${imagenSrc}" alt="${categoria.nombre_categoria}" class="img-thumbnail mr-3" style="width: 50px; height: 50px;">
                        <div class="producto-info d-flex gap-2">
                            <strong class="">
                                ${categoria.nombre_categoria}
                            </strong>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning btn-editar"
                            data-bs-toggle="modal" data-bs-target="#modalEditarCategoria"
                            data-id="${categoria.id_categoria}"
                            data-nombre="${categoria.nombre_categoria}">
                            <i class="bi bi-pencil"></i> Editar 
                        </button>

                        <button type="button" class="btn btn-sm btn-danger btn-eliminarCat" data-id="${categoria.id_categoria}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
                `;

            resultadosContainerCategorias.appendChild(div);
        });
    }






});