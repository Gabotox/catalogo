const btnCarrito = document.querySelector('#btnCantidadCarrito');
const cantidadInput = document.querySelector('#cantidad');
const nombreProducto = document.querySelector('#nombreProducto');
const imagenProducto = document.querySelector('#imagenProducto');
const precioProducto = document.querySelector('#precioProducto');
let listaCarrito = JSON.parse(localStorage.getItem('listaCarrito')) || []; // Inicializa la lista del carrito

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('#btnAddCarrito').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const id_producto = btn.getAttribute('prod');
            const nombre = btn.getAttribute('data-nombre');
            const imagen = btn.getAttribute('data-imagen');
            const precio = parseFloat(btn.getAttribute('data-precio')) || 0;

            // Obtiene la cantidad correcta desde el input más cercano
            const cantidadInput = btn.closest('.card-body').querySelector('.cantidad');
            const cantidad = parseInt(cantidadInput.value) || 1;

            if (isNaN(cantidad) || cantidad < 1) {
                alert("La cantidad debe ser un número válido mayor que 0.");
                return;
            }
            agregarCarrito(id_producto, nombre, imagen, precio, cantidad);
        });
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
            duration: 1500, // Duración en milisegundos
            gravity: "bottom", // Posición vertical (arriba o abajo)
            position: "left", // Posición horizontal (left, center, right)
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
        }).showToast();
    } else {
        // Si el producto no existe, agrégalo al carrito
        listaCarrito.push({
            id_producto: id_producto,
            nombre: nombre,
            imagen: imagen,
            precio: parseFloat(precio).toFixed(3),
            cantidad: parseInt(cantidad)
        });
        Toastify({
            text: "Producto agregado al carrito",
            className: "info",
            duration: 1500, // Duración en milisegundos
            gravity: "bottom", // Posición vertical (arriba o abajo)
            position: "left", // Posición horizontal (left, center, right)
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
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
        const precio = Number(producto.precio);
        const subtotal = precio * Number(producto.cantidad); // Calcular subtotal

        total += subtotal;


        const productoHTML = `
            <div class="producto-carrito">
                <img src="${producto.imagen}" alt="${producto.nombre}" class="img-fluid">
                <div class="info">
                    <h5>${producto.nombre}</h5>
                    <p>Cantidad: <span class="badge bg-primary">${producto.cantidad}</span></p>
                    <p>Precio: <span class="badge bg-warning">$${precio.toLocaleString('es-CL', { minimumFractionDigits: 3, maximumFractionDigits: 3 })}</span></p>
                </div>
                
                <div class="acciones">
                    <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito('${producto.id_producto}')">
                            <i class="fas fa-trash"></i>
                        </button>
                </div>
            </div>
        `;


        totalAPagar.textContent = `$${total.toLocaleString('es-CL', { minimumFractionDigits: 0, maximumFractionDigits: 3 })}`;
        contenedorCarrito.innerHTML += productoHTML;
    });
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