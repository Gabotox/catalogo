<?php
class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Inicio';
        $data['vista'] = "Views/Dashboard/Pages/Inicio.php";
        $this->views->getView('Dashboard', "index", $data);
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

        // 🔹 Obtener todas las categorías (nueva línea)
        $data['categorias'] = $this->model->getTodasLasCategorias();

        // Pasar la información de paginación a la vista
        $data['totalPaginas'] = $totalPaginas;
        $data['paginaActual'] = $paginaActual;
        $data['vista'] = "Views/Dashboard/Pages/Productos.php";

        // Cargar la vista
        $this->views->getView('Dashboard', "index", $data);
    }



    public function categorias()
    {
        $data['title'] = "Categorias";

        // Obtener total de productos
        $totalCategorias = $this->model->contarCategorias();

        $categoriasPorPagina = 5;

        // Calcular total de páginas
        $totalPaginas = ceil($totalCategorias['total'] / $categoriasPorPagina);

        // Obtener la página actual (desde URL, por defecto página 1)
        $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
        if ($paginaActual < 1) {
            $paginaActual = 1;
        }

        // Calcular el inicio de los productos en la consulta SQL
        $inicio = ($paginaActual - 1) * $categoriasPorPagina;

        // Obtener productos paginados
        $data['categorias'] = $this->model->getCategorias($inicio, $categoriasPorPagina);

        // Pasar la información de paginación a la vista
        $data['totalPaginas'] = $totalPaginas;
        $data['paginaActual'] = $paginaActual;


        $data['vista'] = "Views/Dashboard/Pages/Categorias.php";
        $this->views->getView('Dashboard', "index", $data);
    }

    public function configuracion()
    {
        $data['title'] = "Configuración";
        $data['vista'] = "Views/Dashboard/Pages/configuracion.php";
        $this->views->getView('Dashboard', "index", $data);
    }








    // Funciones CRUD


    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($data["nombre"]) ||
            !isset($data["precio"]) ||
            !isset($data["descripcion"]) ||
            !isset($data["disponible"]) ||
            !isset($data["categoria"])
        ) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        $nombre = trim($data["nombre"]);
        $precio = trim($data["precio"]);
        $descripcion = trim($data["descripcion"]);
        $categoria = trim($data["categoria"]);
        $disponible = trim($data["disponible"]);
        $imagen = $data['imagen'];


        if (empty($nombre) || empty($precio) || empty($descripcion) || empty($categoria) || empty($disponible)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }


        $resultadoAgregar = $this->model->agregarProducto([
            "nombre" => $nombre,
            "precio" => $precio,
            "descripcion" => $descripcion,
            "categoria" => $categoria,
            "disponible" => $disponible,
            "imagen" => $imagen
        ]);

        if ($resultadoAgregar) {
            echo json_encode(["status" => "success", "message" => "Producto agregado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al agregar el producto"]);
        }
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($data["id"]) ||
            !isset($data["nombre"]) ||
            !isset($data["precio"]) ||
            !isset($data["descripcion"]) ||
            !isset($data["disponible"]) ||
            !isset($data["categoria"])
        ) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        $idProducto = trim($data["id"]);
        $nombre = trim($data["nombre"]);
        $precio = trim($data["precio"]);
        $descripcion = trim($data["descripcion"]);
        $categoria = trim($data["categoria"]);
        $disponible = trim($data["disponible"]);

        if (empty($nombre) || empty($precio) || empty($idProducto) || empty($descripcion) || empty($categoria) || empty($disponible)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }




        $resultadoEditar = $this->model->editarProducto([
            "id" => $idProducto,
            "nombre" => $nombre,
            "precio" => $precio,
            "descripcion" => $descripcion,
            "categoria" => $categoria,
            "disponible" => $disponible
        ]);

        if ($resultadoEditar) {
            echo json_encode(["status" => "success", "message" => "Producto actualizado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al actualizar el producto"]);
        }
    }

    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["id_producto"])) {
            echo json_encode(["status" => "error", "message" => "ID de producto es obligatorio"]);
            return;
        }

        $idProducto = trim($data["id_producto"]);

        if (empty($idProducto)) {
            echo json_encode(["status" => "error", "message" => "ID de producto es obligatorio"]);
            return;
        }

        $resultadoEliminar = $this->model->eliminarProducto($idProducto);

        if ($resultadoEliminar) {
            echo json_encode(["status" => "success", "message" => "Producto eliminado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al eliminar el producto"]);
        }
    }

    public function agregarCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["nombre"])) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        $nombre = trim($data['nombre']);

        if (empty($nombre)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        $resultadoAgregarCategoria = $this->model->agregarCategoria([
            "nombre" => $nombre
        ]);

        if ($resultadoAgregarCategoria) {
            echo json_encode(["status" => "success", "message" => "Categoría agregada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al agregar la categoria"]);
        }
    }
}
