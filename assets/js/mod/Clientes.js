document.addEventListener('DOMContentLoaded', () => {
    mostrarCarrito();

    // Ocultar el botón si el carrito está vacío
    const btnPagarPedido = document.querySelector('#btnEnviarPedido');
    const alertaCarritoVacio = document.querySelector('#alertaCarritoVacio');
    const btnVolver = document.querySelector('#btnVolver');
    if (btnPagarPedido && alertaCarritoVacio) {
        if (listaCarrito.length === 0) {
            alertaCarritoVacio.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <strong>¡Atención!</strong> Actualmente no tienes nada en el carrito.
                </div>`;

            btnVolver.style.display = 'block';
            btnVolver.innerHTML = `<i class="fas fa-shopping-cart"></i> Añadir productos`;
            btnPagarPedido.style.display = 'none';
        } else {
            alertaCarritoVacio.innerHTML = ""; // Borra la alerta si el carrito tiene productos
            btnVolver.style.display = 'none';
            btnPagarPedido.innerHTML = `<i class="fas fa-credit-card"></i> Procesar pedido`;
            btnPagarPedido.classList.remove('btn-danger');
            btnPagarPedido.classList.add('btn-success');
            btnPagarPedido.href = '<?php echo BASE_URL . "clientes"; ?>'; // Redirige a la página de pago
        }
    }
});

function mostrarCarrito() {
    const contenedorCarrito = document.querySelector('#tableListaCarrito tbody'); // Asegurar tbody
    contenedorCarrito.innerHTML = '';

    const btnPagar = document.querySelector('#btnPagar');

    if (listaCarrito.length === 0) {
        contenedorCarrito.innerHTML = `
            <tr>
                <td colspan="5" class="text-center">El carrito está vacío.</td>
            </tr>`;
        if (btnPagar) btnPagar.style.display = 'none';
        document.querySelector('#totalProducto').textContent = "Total a pagar: $0";
        return;
    }

    if (btnPagar) btnPagar.style.display = 'block';

    let total = 0; // Inicializar total correctamente como número

    listaCarrito.forEach((producto) => {

        const precioUnitario = Number(producto.precio); // Convertir a número
        const precioTotal = precioUnitario * Number(producto.cantidad); // Asegurar que sean números
        total += precioTotal; // Sumar correctamente

        const productoHTML = `
            <tr>
                <td>
                    <img src="${producto.imagen}" alt="${producto.nombre}" class="img-fluid" width="50">
                </td>
                <td>${producto.nombre}</td>
                <td><span class="badge bg-warning">$${precioUnitario.toLocaleString('es-CL', { minimumFractionDigits: 3, maximumFractionDigits: 3 })}</span></td>
                <td><span class="badge bg-primary">${producto.cantidad}</span></td>
                <td><span class="badge bg-danger">$${precioTotal.toLocaleString('es-CL', { minimumFractionDigits: 3, maximumFractionDigits: 3 })}</span></td>
                <td class="text-center">
                    <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito('${producto.id_producto}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>`;

        contenedorCarrito.innerHTML += productoHTML;
    });

    // Formatear el total antes de mostrarlo
    const precioTotalFormateado = total.toLocaleString('es-CL', { minimumFractionDigits: 0, maximumFractionDigits: 3 });
    document.querySelector('#totalProducto').textContent = `$${precioTotalFormateado}`;

}

function eliminarDelCarrito(id_producto) {
    listaCarrito = listaCarrito.filter(item => item.id_producto !== id_producto);
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));

    mostrarCarrito();
    cantidadCarrito();
    Toastify({
        text: "Producto eliminado del carrito",
        className: "info",
        duration: 1500, // Duración en milisegundos
        gravity: "bottom", // Posición vertical (arriba o abajo)
        position: "left", // Posición horizontal (left, center, right)
        style: {
            background: "linear-gradient(to right, #ff416c, #ff4b2b)",
        }
    }).showToast();
}
document.getElementById('formularioPedido').addEventListener('submit', function (event) {
    event.preventDefault();

    // Capturar los datos del formulario
    const nombre = document.getElementById('nombre').value;
    const telefono = document.getElementById('telefono').value;
    const direccion = document.getElementById('direccion').value;
    const notas = document.getElementById('notas').value;

    // Crear el mensaje de WhatsApp con un diseño mejorado
    let mensaje = `¡Hola!\n\n`;
    mensaje += `Quiero realizar un pedido, mis datos son los siguientes:\n\n`;
    mensaje += `*Nombre:* ${nombre}\n`;
    mensaje += `*Teléfono:* ${telefono}\n`;
    mensaje += `*Dirección:* ${direccion}\n`;
    mensaje += `*Nota Adicional:* ${notas}\n\n`;
    mensaje += `----------------------\n`;
    mensaje += `*PEDIDO:*\n`;
    mensaje += `----------------------\n\n`;

    // Recorrer los productos y agregarlos al mensaje
    listaCarrito.forEach((producto) => {
        const precioUnitario = Number(producto.precio); // Convertir precio a número
        const precioTotal = precioUnitario * Number(producto.cantidad); // Calcular total correctamente

        // Formatear valores para que mantengan 3 decimales
        const precioTotalFormateado = precioTotal.toFixed(3);
        const precioUnitarioFormateado = precioUnitario.toFixed(3);

        mensaje += `*Producto:* ${producto.nombre}\n`;
        mensaje += `*Cantidad:* ${producto.cantidad}\n`;
        mensaje += `*Valor unitario:* $${precioUnitarioFormateado}\n`;
        mensaje += `*Valor total:* $${precioTotalFormateado}\n`;
        mensaje += `----------------------\n`;
    });

    // Calcular el total general
    const total = listaCarrito.reduce((sum, producto) => sum + (Number(producto.precio) * Number(producto.cantidad)), 0);

    // Agregar el total al mensaje
    mensaje += `\n----------------------\n`;
    mensaje += `*TOTAL A PAGAR*\n`;
    mensaje += `$${total.toFixed(3)}\n`;
    mensaje += `----------------------\n\n`;
    mensaje += `¡Gracias!`;

    // Codificar el mensaje para la URL de WhatsApp
    const mensajeCodificado = encodeURIComponent(mensaje);

    // Número de WhatsApp al que se enviará el mensaje
    const numeroWhatsApp = '573115140908'; // Reemplaza con tu número de WhatsApp

    // Redirigir a WhatsApp
    window.open(`https://wa.me/${numeroWhatsApp}?text=${mensajeCodificado}`, '_blank');

    // Mostrar Toastify inmediatamente
    Toastify({
        text: "Gracias por su pedido, en unos segundos será redirigido",
        className: "info",
        duration: 7000, // Duración de 4 segundos
        gravity: "top", // Posición en la parte inferior
        position: "left", // Izquierda
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        }
    }).showToast();

    // Esperar 10 segundos antes de limpiar el carrito y redirigir
    setTimeout(() => {
        // Limpiar el carrito
        listaCarrito = [];
        localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));

        // Redirigir al usuario al inicio después de 10 segundos
        window.location.href = "http://localhost/ecommerce/"; // BASE_URL debe estar definido en un <script> en el HTML
    }, 9000); // 10 segundos en total

});
