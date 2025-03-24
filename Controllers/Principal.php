<?php
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }


    public function productos()
    {
        $data['title'] = "Productos";

        // Obtener total de productos
        $totalProductos = $this->model->contarProductos();
        $productosPorPagina = 10;

        // Calcular total de páginas
        $totalPaginas = ceil($totalProductos['total'] / $productosPorPagina);

        // Obtener la página actual
        $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
        if ($paginaActual < 1) {
            $paginaActual = 1;
        }

        // Calcular el inicio de los productos en la consulta SQL
        $inicio = ($paginaActual - 1) * $productosPorPagina;

        // Obtener productos paginados
        $data['productos'] = $this->model->getProductos($inicio, $productosPorPagina);

        // 🔹 Cargar categorías sin afectar la paginación
        $data["todasCategorias"] = $this->model->getTodasLasCategorias();

        // Pasar la información de paginación a la vista
        $data['totalPaginas'] = $totalPaginas;
        $data['paginaActual'] = $paginaActual;

        // Cargar la vista
        $this->views->getView('principal', "productos", $data);
    }

    public function filtrarProductos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $minPrecio = isset($_POST['minPrecio']) ? (float)$_POST['minPrecio'] : 0;
            $maxPrecio = isset($_POST['maxPrecio']) ? (float)$_POST['maxPrecio'] : PHP_FLOAT_MAX;
            $pagina = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;
            $productosPorPagina = 9; // Ajusta según necesites
            $inicio = ($pagina - 1) * $productosPorPagina;

            // Obtener productos filtrados
            $productos = $this->model->obtenerProductosFiltrados($minPrecio, $maxPrecio, $inicio, $productosPorPagina);
            $totalProductos = $this->model->contarProductosFiltrados($minPrecio, $maxPrecio);
            $totalPaginas = ceil($totalProductos / $productosPorPagina);

            // Verificar si se obtuvo un array válido
            if (!is_array($productos)) {
                error_log("Error: La consulta no devolvió un array válido.");
                echo json_encode(["error" => "No se encontraron productos"]);
                return;
            }

            // Enviar respuesta JSON
            echo json_encode([
                "productos" => $productos,
                "totalPaginas" => $totalPaginas,
                "paginaActual" => $pagina
            ]);
        }
    }

    public function filtrarPorCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $minPrecio = $_POST['minPrecio'] ?? 0;
            $maxPrecio = $_POST['maxPrecio'] ?? 999999;
            $categoria = $_POST['categoria'] ?? null;
            $pagina = $_POST['pagina'] ?? 1;
            $productosPorPagina = 9;
            $inicio = ($pagina - 1) * $productosPorPagina;

            if (!$categoria) {
                echo json_encode(['error' => 'Categoría no especificada']);
                return;
            }

            $productos = $this->model->getProductosPorCategoria($categoria, $minPrecio, $maxPrecio, $inicio, $productosPorPagina);
            $totalProductos = $this->model->contarProductosPorCategoria($categoria, $minPrecio, $maxPrecio);
            $totalPaginas = ceil($totalProductos / $productosPorPagina);

            echo json_encode([
                'productos' => $productos,
                'paginaActual' => (int) $pagina,
                'totalPaginas' => (int) $totalPaginas
            ]);
        }
    }

    public function detail($id_producto)
    {
        $data['producto'] = $this->model->getProducto($id_producto);
        $id_categoria = $data['producto']['categoria_id'];
        $data['relacionados'] = $this->model->getAleatorios($id_categoria);
        $data['title'] = $data['producto']['nombre_producto'];
        $this->views->getView('principal', "detail", $data);
    }
    public function categoria($id_categoria)
    {
        $data['categoria'] = $this->model->getCategoria($id_categoria);
        $data['title'] = $data['categoria'][0]['nombre_categoria'];
        $data["id_categoria"] = $id_categoria;
        $this->views->getView('principal', "categoria", $data);
    }
}
