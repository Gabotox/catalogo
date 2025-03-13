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

        // Obtener la página actual (desde URL, por defecto página 1)
        $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
        if ($paginaActual < 1) {
            $paginaActual = 1;
        }

        // Calcular el inicio de los productos en la consulta SQL
        $inicio = ($paginaActual - 1) * $productosPorPagina;

        // Obtener productos paginados
        $data['productos'] = $this->model->getProductos($inicio, $productosPorPagina);

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



    public function editar()
    {
        header('Content-Type: application/json'); // Forzar respuesta JSON

        // Leer los datos JSON
        $data = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($data["id"]) ||
            !isset($data["nombre"]) ||
            !isset($data["precio"]) ||
            !isset($data["descripcion"]) ||
            !isset($data["cantidad"]) ||
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


        // Verificar que los campos no estén vacíos
        if (empty($nombre) || empty($precio) || empty($idProducto) || empty($descripcion) || empty($categoria)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        $editarProducto = new DashboardModel();

        $exito = $editarProducto;

        print_r($data);
        die();
    }
}
