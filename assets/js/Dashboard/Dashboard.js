
let datosOriginalesCategoria = {};
let datosOriginalesProducto = {};

document.addEventListener("DOMContentLoaded", function () {


    // Verificar si los modales existen antes de agregar eventos
    const modalEditar = document.getElementById("modalEditar");
    const modalVer = document.getElementById("modalVer");
    const modalEditarCategoria = document.getElementById("modalEditarCategoria");





    if (modalEditar) {
        modalEditar.addEventListener("show.bs.modal", function (event) {
            let boton = event.relatedTarget;
            if (!boton) return;

            let id = boton.getAttribute("data-id") || "";
            let nombre = boton.getAttribute("data-nombre") || "";
            let precio = boton.getAttribute("data-precio") || "0";
            precio = parseFloat(precio.replace(/[^0-9.]/g, "")).toFixed(0);
            let descripcion = boton.getAttribute("data-descripcion") || "";
            let disponible = boton.getAttribute("data-disponible") || "";
            let categoria = boton.getAttribute("data-categoria") || "";
            let imagen = boton.getAttribute("data-imagen") || "";

            datosOriginalesProducto = {
                id: id || "",
                nombre: nombre || "",
                precio: precio || "",
                descripcion: descripcion || "",
                disponible: disponible || "",
                categoria: categoria || "",
                imagen: imagen || ""
            };



            document.getElementById("editar-producto-preview").src = imagen;
            document.getElementById("editar-producto-id").value = id;
            document.getElementById("editar-producto-nombre").value = nombre;
            document.getElementById("editar-producto-precio").value = precio;
            document.getElementById("editar-producto-descripcion").value = descripcion;
            document.getElementById("editar-producto-disponible").value = disponible;
            document.getElementById("editar-producto-categoria").value = categoria;

        });
    }


    if (modalVer) {
        modalVer.addEventListener("show.bs.modal", function (event) {
            let boton = event.relatedTarget;
            if (!boton) return;

            let imagen = boton.getAttribute("data-imagen") || "ruta_por_defecto.jpg";
            let nombre = boton.getAttribute("data-nombre") || "Sin nombre";
            let precio = boton.getAttribute("data-precio") || "0.00";
            let descripcion = boton.getAttribute("data-descripcion") || "Sin descripción";
            let disponible = boton.getAttribute("data-disponible") || "0";
            let nombreCategoria = boton.getAttribute("data-nombreCategoria") || "No definida";

            document.getElementById("ver-producto-imagen").src = imagen;
            document.getElementById("ver-producto-nombre").textContent = nombre;
            document.getElementById("ver-producto-precio").textContent = "$" + precio;
            document.getElementById("ver-producto-descripcion").textContent = descripcion;
            document.getElementById("ver-producto-disponible").textContent = disponible + " unidades";
            document.getElementById("ver-producto-categoria").textContent = nombreCategoria;
        });
    }

    if (modalEditarCategoria) {
        modalEditarCategoria.addEventListener("show.bs.modal", function (event) {
            let boton = event.relatedTarget;
            if (!boton) return;

            let id = boton.getAttribute("data-id") || "";
            let nombre = boton.getAttribute("data-nombre") || "";
            let imagen = boton.getAttribute("data-imagen") || "";

            // Guardar los valores originales en datosOriginalesCategoria
            datosOriginalesCategoria = {
                id,
                nombre,
                imagen
            };


            document.getElementById("editar-categoria-id").value = id;
            document.getElementById("editar-categoria-nombre").value = nombre;
            document.getElementById("editar-categoria-preview").src = imagen;


        });
    }
});
