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

    public function ultimosProductos()
    {
        $sql = "SELECT * FROM productos ORDER BY id_producto DESC LIMIT 5";
        $productos = $this->selectAll($sql);

        if (!$productos) {
            return [];
        }

        return $productos; // Devolvemos los productos sin formatear el precio
    }

    public function productosStockBajo()
    {
        $sql = "SELECT COUNT(*) as total FROM productos WHERE cantidad_producto <= 10";
        $resultado = $this->select($sql);

        return $resultado ? $resultado['total'] : 0;
    }

    public function getProductos($inicio, $productosPorPagina)
    {
        $sql = "SELECT p.*, 
               COALESCE(c.nombre_categoria, 'Sin categoría') AS nombre_categoria, 
               c.id_categoria 
        FROM productos p 
        LEFT JOIN categorias c ON p.categoria_id = c.id_categoria 
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
        $sql = "SELECT * FROM categorias ORDER BY nombre_categoria";
        return $this->selectAll($sql);
    }

    public function getCategorias($inicio, $categoriasPorPagina)
    {
        $sql = "SELECT * FROM categorias ORDER BY id_categoria DESC LIMIT $inicio, $categoriasPorPagina";
        return $this->selectAll($sql);
    }













    // APARTADO DE CRUD
    public function agregarProducto($data)
    {
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
        // Depuración: Ver los datos antes de ejecutar la consulta
        error_log(print_r($data, true));

        $sql = "UPDATE productos 
        SET nombre_producto = ?, 
            precio_producto = ?,             
            descripcion_producto = ?, 
            cantidad_producto = ?, 
            imagen_producto = COALESCE(?, imagen_producto), 
            categoria_id = ? 
        WHERE id_producto = ?";

        $resultado = $this->editar($sql, [
            $data["nombre"],
            $data["precio"],
            $data["descripcion"],
            $data["disponible"],
            $data["imagen"] ?? null, // Si no hay nueva imagen, envía null
            $data["categoria"],
            $data["id"]
        ]);


        return $resultado > 0; // Retorna true si hubo filas afectadas
    }


    public function eliminarProducto($id)
    {
        $sql = "DELETE FROM productos WHERE id_producto = ?";
        $resultado = $this->eliminar($sql, [$id]);

        return $resultado > 0; // Retorna true si la eliminación fue exitosa
    }

    public function buscarProductos($query)
    {
        $sql = "SELECT p.*, c.* 
                FROM productos p 
                LEFT JOIN categorias c ON p.categoria_id = c.id_categoria
                WHERE p.nombre_producto LIKE ?";
        $params = ["%$query%"];
        $productos = $this->selectAll($sql, $params);
        return $productos;
    }







    public function agregarCategoria($data)
    {
        $sql = "INSERT INTO categorias (nombre_categoria, imagen_categoria) VALUES (?, ?)";

        $resultado = $this->insertar($sql, [
            $data["nombre"],
            $data["imagen"]
        ]);

        return $resultado > 0;
    }

    public function editarCategoria($data)
    {
        $sql = "UPDATE categorias 
                SET nombre_categoria = ?, 
                    imagen_categoria = COALESCE(?, imagen_categoria) 
                WHERE id_categoria = ?";
        $resultado = $this->editar($sql, [
            $data["nombre"],
            $data["imagen"] ?? null,
            $data["id"]
        ]);

        return $resultado > 0;
    }

    public function buscarCategorias($query)
    {

        $sql = "SELECT *
                FROM categorias
                WHERE nombre_categoria LIKE ?
                ";
        $params = ["%$query%"];
        $categorias = $this->selectAll($sql, $params);
        return $categorias;
    }



    public function eliminarCategoria($id)
    {
        $sql = "DELETE FROM categorias WHERE id_categoria = ?";
        $resultado = $this->eliminar($sql, [$id]);

        return $resultado > 0; // Retorna true si la eliminación fue exitosa
    }
}
