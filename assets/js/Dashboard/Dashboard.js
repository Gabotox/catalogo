// Objeto para almacenar los valores originales del producto
let datosOriginales = {};


document.addEventListener("DOMContentLoaded", function () {

    // Evento cuando se abre el modal de Editar
    document.getElementById("modalEditar").addEventListener("show.bs.modal", function (event) {
        let boton = event.relatedTarget; // Botón que activó el modal

        if (!boton) return; // Evita errores si no hay botón

        // Obtener datos desde los atributos del botón
        let id = boton.getAttribute("data-id") || "";
        let nombre = boton.getAttribute("data-nombre") || "";
        let precio = boton.getAttribute("data-precio") || "0";
        precio = parseFloat(precio.replace(/[^0-9.]/g, "")).toFixed(0);
        let descripcion = boton.getAttribute("data-descripcion") || "";
        let disponible = boton.getAttribute("data-disponible") || "";
        let categoria = boton.getAttribute("data-categoria") || "";

        // Asignar valores al modal de Editar
        document.getElementById("editar-producto-id").value = id;
        document.getElementById("editar-producto-nombre").value = nombre;
        document.getElementById("editar-producto-precio").value = precio;
        document.getElementById("editar-producto-descripcion").value = descripcion;
        document.getElementById("editar-producto-disponible").value = disponible;
        document.getElementById("editar-producto-categoria").value = categoria;

        datosOriginales = {
            id: document.getElementById("editar-producto-id").value,
            nombre: document.getElementById("editar-producto-nombre").value,
            precio: document.getElementById("editar-producto-precio").value,
            descripcion: document.getElementById("editar-producto-descripcion").value,
            disponible: document.getElementById("editar-producto-disponible").value,
            categoria: document.getElementById("editar-producto-categoria").value
        };



        console.log("Valores originales:", datosOriginales); // Depuración

    });

    // Evento cuando se abre el modal de Ver
    document.getElementById("modalVer").addEventListener("show.bs.modal", function (event) {
        let boton = event.relatedTarget; // Botón que activó el modal

        if (!boton) return; // Evita errores si no hay botón

        // Obtener datos del producto desde los atributos del botón
        let imagen = boton.getAttribute("data-imagen") || "ruta_por_defecto.jpg";
        let nombre = boton.getAttribute("data-nombre") || "Sin nombre";
        let precio = boton.getAttribute("data-precio") || "0.00";
        let descripcion = boton.getAttribute("data-descripcion") || "Sin descripción";
        let disponible = boton.getAttribute("data-disponible") || "0";
        let categoria = boton.getAttribute("data-categoria") || "No definida";
        let nombreCategoria = boton.getAttribute("data-nombreCategoria") || "No definida";

        // Asignar valores al modal de Ver
        document.getElementById("ver-producto-imagen").src = imagen;
        document.getElementById("ver-producto-nombre").textContent = nombre;
        document.getElementById("ver-producto-precio").textContent = "$" + precio;
        document.getElementById("ver-producto-descripcion").textContent = descripcion;
        document.getElementById("ver-producto-disponible").textContent = disponible + " unidades";
        document.getElementById("ver-producto-categoria").textContent = nombreCategoria;
    });




    // Evento para el botón de actualización
    document.getElementById("editar").addEventListener("click", async function (event) {


        event.preventDefault(); // Evita el envío tradicional del formulario

        // Obtener los valores actuales del formulario
        let datosProducto = {
            id: document.getElementById("editar-producto-id").value,
            nombre: document.getElementById("editar-producto-nombre").value,
            precio: document.getElementById("editar-producto-precio").value,
            descripcion: document.getElementById("editar-producto-descripcion").value,
            disponible: document.getElementById("editar-producto-disponible").value,
            categoria: document.getElementById("editar-producto-categoria").value
        };

        // 🔍 Validar si los datos son iguales a los originales
        let cambios = Object.keys(datosProducto).some(key => datosProducto[key] !== datosOriginales[key]);

        if (!cambios) {
            Toastify({
                text: "No has actualizado los datos",
                className: "info",
                duration: 1500,
                gravity: "bottom",
                position: "left",
                style: { background: "linear-gradient(to right, #ff416c, #ff4b2b)" }
            }).showToast();
            return;
        }

        // 🚀 Enviar datos si hubo cambios
        try {
            const response = await fetch(base_url + "Dashboard/editar", {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(datosProducto)
            });

            const res = await response.json(); // Convertir respuesta a JSON

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


    // Evento para agregar un producto
    document.getElementById("agregar").addEventListener("click", async function (event) {
        let nombre = document.querySelector("#agregar-producto-nombre").value;
        let descripcion = document.querySelector("#agregar-producto-descripcion").value;
        let precio = document.querySelector("#agregar-producto-precio").value;
        let disponible = document.querySelector("#agregar-producto-disponible").value;
        let categoria = document.querySelector("#agregar-producto-categoria").value;
        let imagen = document.querySelector("#agregar-producto-imagen").value;

        let datosProducto = {
            nombre: nombre,
            descripcion: descripcion,
            precio: precio,
            disponible: disponible,
            categoria: categoria,
            imagen: imagen
        }


        try {
            const response = await fetch(base_url + "Dashboard/agregar", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(datosProducto)
            });

            const res = await response.json(); // Convertir respuesta a JSON

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


    // Evento para eliminar un producto
    document.querySelectorAll(".btn-eliminar").forEach(boton => {
        boton.addEventListener("click", async function () {
            let id = this.getAttribute("data-id");

            if (!confirm("¿Estás seguro de eliminar este producto?")) return;

            try {
                const response = await fetch(base_url + "Dashboard/eliminar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id_producto: id })
                });

                const res = await response.json(); // Convertir respuesta a JSON

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

    });


    // Evento para agregar una categoria
    // Evento cuando se abre el modal de Editar
    document.getElementById("agregarCategoria").addEventListener("click", async function(e) {
        e.preventDefault();

        let nombreCategoria = document.querySelector("#agregar-categoria-nombre").value;


        try {
            const response = await fetch(base_url + "Dashboard/agregarCategoria", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({nombre: nombreCategoria})
            });

            const res = await response.json(); // Convertir respuesta a JSON

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

});
