document.addEventListener('DOMContentLoaded', () => {
    const btnAgregarCarrito = document.querySelector('#btnAgregarCarrito');
    const cantidadInput = document.querySelector('#cantidad');
    const idProducto = document.querySelector('#idProducto');
    const btnMinus = document.querySelector('#btn-minus');
    const btnPlus = document.querySelector('#btn-plus');
    const varValue = document.querySelector('#var-value');

    let cantidad = 1; // Valor inicial de la cantidad

    function actualizarCantidad(nuevaCantidad) {
        cantidad = nuevaCantidad;
        if (varValue) varValue.textContent = cantidad;
        if (cantidadInput) cantidadInput.value = cantidad;
    }

    if (btnMinus) {
        btnMinus.addEventListener('click', () => {
            if (cantidad > 1) {
                actualizarCantidad(cantidad - 1);
            }
        });
    }

    if (btnPlus) {
        btnPlus.addEventListener('click', () => {
            actualizarCantidad(cantidad + 1);
        });
    }

    actualizarCantidad(cantidad);

    if (btnAgregarCarrito) {
        btnAgregarCarrito.addEventListener('click', () => {
            const cantidad = parseInt(cantidadInput?.value || 1);
            const idProductoValue = idProducto?.value;
            const nombreProducto = document.querySelector('#nombreProducto')?.textContent.trim();
            const imagenProducto = document.querySelector('#imagenProducto')?.getAttribute('src');
            const precioTexto = document.querySelector('#precioProducto')?.textContent.trim();
            const precioProducto = parseFloat(precioTexto?.replace(/[^0-9.]/g, '')) || 0;

            if (isNaN(cantidad) || cantidad < 1) {
                alert("La cantidad debe ser un número válido mayor que 0.");
                return;
            }

            agregarCarrito(idProductoValue, nombreProducto, imagenProducto, precioProducto, cantidad);
        });
    }
});
