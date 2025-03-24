document.addEventListener("DOMContentLoaded", function () {
    const priceMin = document.getElementById("priceMin");
    const priceMax = document.getElementById("priceMax");
    const productContainer = document.getElementById("productContainer");

    if (productContainer) {
        // Crear el alert de Bootstrap dinámicamente
        const alertContainer = document.createElement("div");
        alertContainer.id = "noProductsAlert";
        alertContainer.className = "alert alert-warning text-center mt-3";
        alertContainer.style.display = "none"; // Ocultarlo al inicio
        alertContainer.textContent = "No se encontraron productos dentro de este rango de precios.";
        productContainer.parentElement.insertBefore(alertContainer, productContainer); // Insertarlo antes del contenedor

        function loadProducts(page = 1) {
            const minPrice = priceMin.value || 0;
            const maxPrice = priceMax.value || 999999;

            fetch(base_url + "principal/filtrarProductos", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `minPrecio=${minPrice}&maxPrecio=${maxPrice}&pagina=${page}`,
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!Array.isArray(data.productos)) {
                        throw new Error("La clave 'productos' no contiene un array válido");
                    }

                    productContainer.innerHTML = ""; // 🔄 Limpiar productos antes de agregar nuevos

                    if (data.productos.length === 0) {
                        alertContainer.style.display = "block"; // Mostrar alerta si no hay productos
                    } else {
                        alertContainer.style.display = "none"; // Ocultar alerta si hay productos
                    }

                    data.productos.forEach(producto => {
                        const imagenUrl = producto.imagen_producto.includes("http")
                            ? producto.imagen_producto
                            : `http://localhost/ecommerce/assets/img/Productos/${encodeURIComponent(producto.imagen_producto)}`;

                        productContainer.innerHTML += `
                            <div class="col-lg-4 col-md-6 col-sm-6 product-item" data-precio="${producto.precio_producto}">
                                <div class="card" style="margin: 1.5rem;">
                                    <a href="${base_url}principal/detail/${producto.id_producto}" class="card-title">
                                        <img class="card-img-left" src="${imagenUrl}" alt="Imagen del Producto">
                                    </a>
                                    <div class="card-body mt-2">
                                        <h5>${producto.nombre_producto}</h5>
                                        <p class="card-text">${producto.descripcion_producto}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-2 btnAddCarrito">
                                            <a href="#" class="btn btn-add-to-cart d-flex align-items-center gap-2" id="btnAddCarrito" 
                                                prod="${producto.id_producto}" 
                                                data-nombre="${producto.nombre_producto}" 
                                                data-precio="${producto.precio_producto}" 
                                                data-imagen="${imagenUrl}">
                                                <i class="fa-solid fa-bag-shopping"></i> Agregar
                                            </a>
                                            <span class="">$${producto.precio_producto.toLocaleString('es-CL', { minimumFractionDigits: 3, maximumFractionDigits: 3 })}</span>
                                        </div>
                                        <a href="${base_url}principal/detail/${producto.id_producto}" class="ojo">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    updatePagination(data.totalPaginas, data.paginaActual);
                })
                .catch(error => console.error("Error en la solicitud:", error));
        }

        function updatePagination(totalPaginas, paginaActual) {
            const paginationContainer = document.querySelector(".pagination");
            paginationContainer.innerHTML = ""; // Limpiar la paginación

            if (paginaActual > 1) {
                paginationContainer.innerHTML += `<li class="page-item"><a class="page-link text-black" href="#" data-page="${paginaActual - 1}"><i class="fa-solid fa-chevron-left"></i></a></li>`;
            }

            for (let i = 1; i <= totalPaginas; i++) {
                paginationContainer.innerHTML += `<li class="page-item ${i === paginaActual ? "active" : ""}">
                    <a class="page-link text-black" href="#" data-page="${i}">${i}</a>
                </li>`;
            }

            if (paginaActual < totalPaginas) {
                paginationContainer.innerHTML += `<li class="page-item"><a class="page-link text-black" href="#" data-page="${paginaActual + 1}"><i class="fa-solid fa-chevron-right"></i></a></li>`;
            }

            document.querySelectorAll(".pagination a").forEach(link => {
                link.addEventListener("click", function (e) {
                    e.preventDefault();
                    const page = this.getAttribute("data-page");
                    loadProducts(page); // ✅ Ahora sí está definida
                });
            });
        }

        // ✅ Filtrado con paginación
        priceMin.addEventListener("input", () => loadProducts(1));
        priceMax.addEventListener("input", () => loadProducts(1));

        // ✅ Cargar productos al iniciar
        loadProducts();
    }



    const priceMinInput = document.getElementById("priceMinCat");
    const priceMaxInput = document.getElementById("priceMaxCat");
    const categoriaContainer = document.getElementById("categoriaContainer");

    if (categoriaContainer) {
        if (priceMinInput && priceMaxInput && categoriaContainer) {
            // Crear el alert de Bootstrap dinámicamente
            const alertContainer = document.createElement("div");
            alertContainer.id = "noProductsAlert";
            alertContainer.className = "alert alert-warning text-center";
            alertContainer.style.display = "none"; // Ocultarlo al inicio
            alertContainer.textContent = "No se encontraron productos dentro de este rango de precios.";
            categoriaContainer.appendChild(alertContainer); // Agregarlo al contenedor de productos

            function filterProducts() {
                const minPrice = parseFloat(priceMinInput.value.replace(/[,.]/g, '')) || 0;
                const maxPrice = priceMaxInput.value ? parseFloat(priceMaxInput.value.replace(/[,.]/g, '')) : Number.MAX_VALUE;

                let found = false; // Bandera para saber si hay productos visibles

                document.querySelectorAll(".product-itemCat").forEach(product => {
                    const productPrice = parseFloat(product.dataset.precio.replace(/[,.]/g, '')) || 0;

                    if (productPrice >= minPrice && productPrice <= maxPrice) {
                        product.style.display = "block";
                        found = true;
                    } else {
                        product.style.display = "none";
                    }
                });

                // Mostrar u ocultar el alert según si se encontraron productos
                alertContainer.style.display = found ? "none" : "block";
            }

            // Escuchar cambios en los inputs
            priceMinInput.addEventListener("input", filterProducts);
            priceMaxInput.addEventListener("input", filterProducts);
        }
    }


    const searchInput = document.querySelector(".searchInput");
    const resultadosContainer = document.querySelector(".resultadosBusqueda");

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
        console.log("Mostrando productos:", productos);

        resultadosContainer.innerHTML = ""; // Limpiar contenedor
        resultadosContainer.style.display = "block"; // Mostrar el contenedor

        if (!productos || productos.length === 0) {
            resultadosContainer.innerHTML = `<div class="resultado-item text-center">No se encontraron productos</div>`;
            return;
        }


        productos.forEach(producto => {
            let precioTexto = producto.precio_producto.trim();

            let precioProducto;

            // Si el número tiene coma decimal, es formato europeo (1.234,56)
            if (precioTexto.includes(',')) {
                precioProducto = parseFloat(precioTexto.replace(/\./g, '').replace(',', '.'));
            } else {
                // Si no tiene coma, simplemente lo convertimos sin tocar el punto decimal
                precioProducto = parseFloat(precioTexto);
            }


            let imagenSrc = producto.imagen_producto.startsWith("http")
                ? producto.imagen_producto
                : `${base_url}assets/img/Productos/${producto.imagen_producto}`;

            let div = document.createElement("div");
            div.classList.add("resultado-item");

            div.innerHTML = `
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <a href="${base_url}principal/detail/${producto.id_producto}" class="producto-link d-flex align-items-center flex-grow-1">
                            <img src="${imagenSrc}" alt="${producto.nombre_producto}" class="rounded" width="50" height="50">
                            <div class="producto-info mx-3">
                                <b>${producto.nombre_producto}</b>
                                <p class="text-success mb-0">$${precioProducto.toLocaleString('es-CL', { minimumFractionDigits: 0, maximumFractionDigits: 2 })}</p> 
                            </div>
                        </a>
                        <input type="number" class="form-control cantidad mx-2" value="1" min="1" style="width: 60px;">
                        <button class="btn btn-add-to-cart d-flex align-items-center gap-2"
                                prod="${producto.id_producto}"
                                data-nombre="${producto.nombre_producto}"
                                data-imagen="${imagenSrc}"
                                data-precio="${precioProducto}">
                            <i class="fa-solid fa-cart-shopping"></i> 
                            Agregar
                        </button>
                    </div>
                </div>
            `;

            resultadosContainer.appendChild(div);
        });



    }

    // Ocultar el contenedor si se hace clic fuera
    document.addEventListener("click", (e) => {
        if (!searchInput.contains(e.target) && !resultadosContainer.contains(e.target)) {
            resultadosContainer.style.display = "none";
        }
    });
});
