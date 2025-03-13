document.addEventListener("DOMContentLoaded", function () {
    // Evento cuando se abre el modal de Editar
    document.getElementById("modalEditar").addEventListener("show.bs.modal", function (event) {
        let boton = event.relatedTarget; // Botón que activó el modal

        if (!boton) return; // Evita errores si no hay botón

        // Obtener datos desde los atributos del botón
        let id = boton.getAttribute("data-id") || "";
        let nombre = boton.getAttribute("data-nombre") || "";
        let precio = boton.getAttribute("data-precio") || "";
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

    document.getElementById("click").addEventListener("click", async function (event) {
        event.preventDefault(); // Evita el envío tradicional del formulario





        // Obtener los valores del formulario
        let id = document.getElementById("editar-producto-id").value;



        let nombre = document.getElementById("editar-producto-nombre").value;
        let precio = document.getElementById("editar-producto-precio").value;
        let descripcion = document.getElementById("editar-producto-descripcion").value;
        let disponible = document.getElementById("editar-producto-disponible").value;
        let categoria = document.getElementById("editar-producto-categoria").value;


        if (nombre === "" || precio === "" || descripcion === "" || disponible === "" || categoria === "") {
            Toastify({
                text: "Por favor, rellene todos los campos",
                className: "info",
                duration: 1500, // Duración en milisegundos
                gravity: "bottom", // Posición vertical (arriba o abajo)
                position: "left",
                style: {
                    background: "linear-gradient(to right, #ff416c, #ff4b2b)",
                }
            }).showToast();
            return;
        }
        // Crear el objeto con los datos a enviar
        let datosProducto = {
            id: id,
            nombre: nombre,
            precio: parseFloat(precio).toFixed(3), // Asegurar que sea número
            descripcion: descripcion,
            disponible: parseInt(disponible), // Asegurar que sea número entero
            categoria: categoria
        };

        try {
            const response = await fetch(base_url + "Dashboard/editar", {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(datosProducto)
            });

            const res = await response.json();
            console.log("Respuesta del servidor:", res);

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
                    window.location.href = base_url + "Dashboard/index";
                }, 2000);
            }
        } catch (error) {
            console.error("Error en la petición:", error);
        }
    });
});
