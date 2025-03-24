const btnCarrito = document.querySelector('#btnCantidadCarrito');
const cantidadInput = document.querySelector('#cantidad');
const nombreProducto = document.querySelector('#nombreProducto');
const imagenProducto = document.querySelector('#imagenProducto');
const precioProducto = document.querySelector('#precioProducto');
let listaCarrito = JSON.parse(localStorage.getItem('listaCarrito')) || []; // Inicializa la lista del carrito

document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-add-to-cart')) {
            e.preventDefault();

            const btn = e.target; // El botón que se hizo clic
            const id_producto = btn.getAttribute('prod');
            const nombre = btn.getAttribute('data-nombre');
            const imagen = btn.getAttribute('data-imagen');
            const precio = btn.getAttribute('data-precio') || '0';


            // Busca el input cantidad más cercano
            const cantidadInput = btn.closest('.card-body').querySelector('.cantidad');
            const cantidad = cantidadInput ? parseInt(cantidadInput.value) || 1 : 1;

            if (isNaN(cantidad) || cantidad < 1) {
                alert("La cantidad debe ser un número válido mayor que 0.");
                return;
            }

            agregarCarrito(id_producto, nombre, imagen, precio, cantidad);
        }
    });

    cantidadCarrito();
    mostrarContenidoCarrito();



});

function agregarCarrito(id_producto, nombre, imagen, precio, cantidad) {
    // Verifica si el producto ya está en el carrito
    let productoExistente = listaCarrito.find(item => item.id_producto === id_producto);

    if (productoExistente) {
        // Si el producto ya existe, actualiza la cantidad
        productoExistente.cantidad += parseInt(cantidad);
        Toastify({
            text: `Cantidad actualizada: ${productoExistente.cantidad}`,
            className: "info",
            duration: 1500,
            gravity: "bottom",
            position: "left",
            style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
        }).showToast();
    } else {
        // Si el producto no existe, agrégalo al carrito
        listaCarrito.push({
            id_producto: id_producto,
            nombre: nombre,
            imagen: imagen,
            precio: precio, // Almacena el precio como número
            cantidad: parseInt(cantidad)
        });

        console.log(listaCarrito);

        Toastify({
            text: "Producto agregado al carrito",
            className: "info",
            duration: 1500,
            gravity: "bottom",
            position: "left",
            style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
        }).showToast();
    }

    // Guarda la lista actualizada en el localStorage
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));

    // Actualiza el contador del carrito
    cantidadCarrito();
    mostrarContenidoCarrito();
}


function cantidadCarrito() {
    // Verifica si el elemento existe
    if (btnCarrito) {
        // Actualiza el contenido del elemento
        btnCarrito.textContent = listaCarrito.length; // Usa textContent
    }
}

function mostrarContenidoCarrito() {
    const contenedorCarrito = document.querySelector('#contenidoCarrito');
    contenedorCarrito.innerHTML = '';

    const btnPagar = document.querySelector('#btnPagar');
    const totalAPagar = document.querySelector('#totalAPagar');

    if (listaCarrito.length === 0) {
        contenedorCarrito.innerHTML = "<p class='text-center'>El carrito está vacío.</p>";
        if (btnPagar) btnPagar.style.display = 'none';
        return;
    }

    if (btnPagar) btnPagar.style.display = 'block';

    let total = 0;

    listaCarrito.forEach((producto) => {
        // Convierte correctamente el precio a número sin afectar la precisión
        const precioUnitario = parseFloat(producto.precio.replace(/\./g, '').replace(',', '.')); // Corrige formatos con puntos y comas
        const subtotal = precioUnitario * producto.cantidad; // Calcula el subtotal correctamente

        total += subtotal; // Suma correctamente el total

        // 🔥 Formateo correcto sin decimales
        const precioFormateado = precioUnitario.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
        const subtotalFormateado = subtotal.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });


        const productoHTML = `
        <div class="producto-carrito">
            <div class="columna imagen-info">
                <img src="${producto.imagen}" alt="${producto.nombre}" class="img-fluid">
                <div class="info">
                    <h5>${producto.nombre}</h5>
                    <p>Cantidad: <span class="badge bg-primary">${producto.cantidad}</span></p>
                </div>
            </div>
            <div class="columna pagos"> 
                <p>Precio: <span class="badge bg-warning">${precioFormateado}</span></p>
                <p>Subtotal: <span class="badge bg-success">${subtotalFormateado}</span></p>
            </div>
            <div class="columna acciones">
                <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito('${producto.id_producto}')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;

        contenedorCarrito.innerHTML += productoHTML;
    });

    // 🔥 Formateo final del total sin decimales
    totalAPagar.textContent = total.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });


}


// Función para eliminar un producto del carrito
function eliminarDelCarrito(id_producto) {
    listaCarrito = listaCarrito.filter(item => item.id_producto !== id_producto);
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));

    mostrarContenidoCarrito();
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

// Llama a la función para mostrar el contenido del carrito cuando se abre el modal
document.getElementById('carritoModal').addEventListener('shown.bs.modal', () => {
    mostrarContenidoCarrito();
});



