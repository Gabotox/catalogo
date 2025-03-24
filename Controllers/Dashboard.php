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
        $data['totalProductos'] = $this->model->contarProductos()['total'];
        $data['totalCategorias'] = $this->model->contarCategorias()['total'];
        $data['ultimosProductos'] = $this->model->ultimosProductos();
        $data['productosStockBajo'] = $this->model->productosStockBajo();
        $data['todasCategorias']  = $this->model->getTodasLasCategorias();
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

        // 🔹 Cargar categorías sin afectar la paginación
        $data["todasCategorias"] = $this->model->getTodasLasCategorias();

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
        // 🔹 Cargar todas las categorías sin afectar la paginación

        $data["todasCategorias"] = $this->model->getTodasLasCategorias();


        // 🔹 Obtener todas las categorías (nueva línea)

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



    //Para Productos
    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        // Obtener datos del formulario
        $nombre = trim($_POST["nombre"] ?? "");
        $precio = trim($_POST["precio"] ?? "");
        $descripcion = trim($_POST["descripcion"] ?? "");
        $categoria = trim($_POST["categoria"] ?? "");
        $disponible = trim($_POST["disponible"] ?? "");

        if (empty($nombre) || empty($precio) || empty($descripcion) || empty($categoria) || empty($disponible)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }



        // Manejo de la imagen
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            $directorioDestino = __DIR__ . "/../assets/img/Productos/";

            if (!file_exists($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            $nombreArchivo = time() . "_" . basename($_FILES["imagen"]["name"]);
            $rutaArchivo = $directorioDestino . $nombreArchivo;

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaArchivo)) {
                $imagen = "assets/img/Productos/" . $nombreArchivo;  // Ruta relativa
            } else {
                echo json_encode(["status" => "error", "message" => "Error al subir la imagen"]);
                return;
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Imagen no válida"]);
            return;
        }

        // Guardar en la base de datos
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }


        $idProducto = trim($_POST["id"] ?? "");
        $nombre = trim($_POST["nombre"] ?? "");
        $precio = trim($_POST["precio"] ?? "");
        $descripcion = trim($_POST["descripcion"] ?? "");
        $categoria = trim($_POST["categoria"] ?? "");
        $disponible = trim($_POST["disponible"] ?? "");


        if (empty($nombre) || empty($precio) || empty($idProducto) || empty($descripcion) || empty($categoria) || empty($disponible)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        $imagenActual = $_POST["imagen_actual"] ?? null;
        $imagen = $imagenActual; // Usar la imagen actual por defecto

        if (!empty($_FILES["imagen"]["name"])) {
            $directorioDestino = "assets/img/Productos/";
            $nombreArchivo = time() . "_" . basename($_FILES["imagen"]["name"]);
            $rutaCompleta = $directorioDestino . $nombreArchivo;

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompleta)) {
                $imagen = $nombreArchivo; // Usar la nueva imagen si se subió correctamente
            } else {
                echo json_encode(["status" => "error", "message" => "Error al subir la imagen"]);
                return;
            }
        }


        // Llamada al modelo para actualizar los datos
        $resultadoEditar = $this->model->editarProducto([
            "id" => $idProducto,
            "nombre" => $nombre,
            "precio" => $precio,
            "descripcion" => $descripcion,
            "categoria" => $categoria,
            "disponible" => $disponible,
            "imagen" => $imagen // Puede ser null si no se subió una nueva imagen
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

    public function buscarProductos()
    {
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';

        if (!empty($query)) {
            $productos = $this->model->buscarProductos($query);

            if (!$productos) {
                $productos = []; // Garantizar que sea un array vacío en caso de error
            }

            echo json_encode($productos);
        } else {
            echo json_encode([]);
        }
    }




    // PARA CATEGORIAS
    public function agregarCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        if (!isset($_POST["nombre"]) || !isset($_FILES["imagen"])) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        $nombre = trim($_POST['nombre'] ?? "");


        if (empty($nombre)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }



        if (isset($_FILES['imagen']) && $_FILES["imagen"]["error"] == 0) {
            $directorioDestino = __DIR__ . "/../assets/img/Categorias/";

            if (!file_exists($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            $nombreArchivo = time() . "_" . basename($_FILES["imagen"]["name"]);
            $rutaCompleta = $directorioDestino . $nombreArchivo;

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompleta)) {
                $imagen = 'assets/img/Categorias/' . $nombreArchivo;
            } else {
                echo json_encode(["status" => "error", "message" => "Error al subir la imagen"]);
                return;
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Imagen no válida"]);
            return;
        }



        $resultadoAgregarCategoria = $this->model->agregarCategoria([
            "nombre" => $nombre,
            "imagen" => $imagen
        ]);

        if ($resultadoAgregarCategoria) {
            echo json_encode(["status" => "success", "message" => "Categoría agregada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al agregar la categoria"]);
        }
    }

    public function editarCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        if (
            !isset($_POST["id"]) ||
            !isset($_POST["nombre"])
        ) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }


        // Manejo de la imagen
        $imagenActual = $_POST["imagen_actual"] ?? null;
        $imagen = $imagenActual; // Usar la imagen actual por defecto
        
        if (!empty($_FILES["imagen"]["name"])) {
            $directorioDestino = "assets/img/Categorias/";
            $nombreArchivo = time() . "_" . basename($_FILES["imagen"]["name"]);
            $rutaCompleta = $directorioDestino . $nombreArchivo;

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompleta)) {
                $imagen = $nombreArchivo;
            } else {
                echo json_encode(["status" => "error", "message" => "Error al subir la imagen"]);
                return;
            }
        }

        $idCategoria = trim($_POST["id"]);
        $nombre = trim($_POST["nombre"]);


        if (empty($nombre) || empty($idCategoria)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }


        $resultadoEditar = $this->model->editarCategoria([
            "id" => $idCategoria,
            "nombre" => $nombre,
            "imagen" => $imagen
        ]);

        if ($resultadoEditar) {
            echo json_encode(["status" => "success", "message" => "Categoría actualizada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al actualizar la categoría"]);
        }
    }

    public function eliminarCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["id_categoria"])) {
            echo json_encode(["status" => "error", "message" => "ID de la Categoria es obligatorio"]);
            return;
        }

        $idCategoria = trim($data["id_categoria"]);

        if (empty($idCategoria)) {
            echo json_encode(["status" => "error", "message" => "ID de la Categoria es obligatorio"]);
            return;
        }

        $resultadoEliminarCategoria = $this->model->eliminarCategoria($idCategoria);

        if ($resultadoEliminarCategoria) {
            echo json_encode(["status" => "success", "message" => "Categoria eliminada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al eliminar la categoria"]);
        }
    }
    public function buscarCategorias()
    {
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';

        if (!empty($query)) {
            $productos = $this->model->buscarCategorias($query);

            if (!$productos) {
                $productos = []; // Garantizar que sea un array vacío en caso de error
            }

            echo json_encode($productos);
        } else {
            echo json_encode([]);
        }
    }
}
