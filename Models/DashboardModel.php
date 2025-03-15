<?php
class DashboardModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function contarProductos()
    {
        $sql = "SELECT COUNT(*) as total FROM productos";
        $resultado = $this->select($sql);

        // Verifica si hay un resultado válido
        return $resultado ? $resultado : ['total' => 0];
    }


    public function getProductos($inicio, $productosPorPagina)
    {
        $sql = "SELECT p.*, c.* 
            FROM productos p 
            INNER JOIN categorias c ON p.categoria_id = c.id_categoria 
            ORDER BY p.id_producto DESC
            LIMIT $inicio, $productosPorPagina";

        $productos = $this->selectAll($sql);

        if (!$productos) {
            return [];
        }

        return $productos; // Devolvemos los productos sin formatear el precio
    }

    public function contarCategorias()
    {
        $sql = "SELECT COUNT(*) as total FROM categorias";
        $resultado = $this->select($sql);

        // Si el resultado no es un array o no tiene la clave 'total', devuelve un array por defecto
        return is_array($resultado) && isset($resultado['total']) ? $resultado : ['total' => 0];
    }

    public function getTodasLasCategorias()
    {
        $sql = "SELECT DISTINCT id_categoria, nombre_categoria FROM categorias ORDER BY nombre_categoria";
        return $this->selectAll($sql);
    }

    public function getCategorias($inicio, $categoriasPorPagina)
    {
        $sql = "SELECT * FROM categorias ORDER BY id_categoria DESC LIMIT $inicio, $categoriasPorPagina";
        return $this->selectAll($sql);
    }








    // APARTADO DE CRUD
    public function agregarProducto($data){
        $sql = "INSERT INTO productos (nombre_producto, precio_producto, descripcion_producto, cantidad_producto, imagen_producto, categoria_id) VALUES (?, ?, ?, ?, ?, ?)";
        $resultado = $this->insertar($sql, [
            $data["nombre"],
            $data["precio"],
            $data["descripcion"],
            $data["disponible"],
            $data["imagen"],
            $data["categoria"]
        ]);

        return $resultado > 0; // Retorna true si la inserción fue exitosa

    }

    public function editarProducto($data)
    {
        $sql = "UPDATE productos SET nombre_producto = ?, precio_producto = ?, descripcion_producto = ?, cantidad_producto = ?, categoria_id = ? WHERE id_producto = ?";


        error_log("Datos recibidos en editarProducto: " . print_r($data, true));


        $resultado = $this->editar($sql, [
            $data["nombre"],
            $data["precio"],
            $data["descripcion"],
            $data["disponible"],
            $data["categoria"],
            $data["id"]
        ]);
        // Verificar si hubo filas afectadas
        if ($resultado === 0) {
            error_log("Consulta ejecutada pero sin filas afectadas. Posibles causas: el ID no existe o los valores no cambiaron.");
        }

        return $resultado > 0;


        return $resultado > 0; // Retorna true si hubo filas afectadas
    }

    public function eliminarProducto($id)
    {
        $sql = "DELETE FROM productos WHERE id_producto = ?";
        $resultado = $this->eliminar($sql, [$id]);

        return $resultado > 0; // Retorna true si la eliminación fue exitosa
    }


    public function agregarCategoria($data){
        $sql = "INSERT INTO categorias (nombre_categoria) VALUES (?)";

        $resultado = $this->insertar( $sql, [
            $data["nombre"]
        ]);

        return $resultado > 0 ;
    }
}
