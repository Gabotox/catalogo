<?php
class PrincipalModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getProducto($id_producto)
    {
        $sql = "SELECT p.*, c.nombre_categoria 
            FROM productos p 
            INNER JOIN categorias c ON p.categoria_id = c.id_categoria 
            WHERE p.id_producto = '$id_producto'";

        $producto = $this->select($sql);

        if ($producto) {
            $producto['precio_producto'] = number_format($producto['precio_producto'], 0, ',', '.');
        }

        return $producto;
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

    public function obtenerProductosFiltrados($minPrecio, $maxPrecio, $inicio, $productosPorPagina)
    {
        $sql = "SELECT * FROM productos 
            WHERE precio_producto BETWEEN :minPrecio AND :maxPrecio
            LIMIT $inicio, $productosPorPagina";  // 👈 PASAR DIRECTAMENTE COMO ENTEROS

        $params = [
            ':minPrecio' => $minPrecio,
            ':maxPrecio' => $maxPrecio
        ];

        $resultado = $this->selectAll($sql, $params);

        if ($resultado === false) {
            error_log("Error en obtenerProductosFiltrados: consulta fallida.");
            return [];
        }

        foreach ($resultado as &$producto) {
            $producto['precio_producto'] = number_format($producto['precio_producto'], 0, ',', '.');
        }

        return $resultado;
    }


    public function contarProductosFiltrados($minPrecio, $maxPrecio)
    {
        $sql = "SELECT COUNT(*) as total FROM productos 
                WHERE precio_producto 
                BETWEEN :minPrecio AND :maxPrecio";

        $params = [
            ':minPrecio' => $minPrecio,
            ':maxPrecio' => $maxPrecio
        ];

        $resultado = $this->select($sql, $params);

        return $resultado ? $resultado['total'] : 0;
    }









    public function getCategoria($id_categoria)
    {
        $sql = "SELECT p.*, c.nombre_categoria 
            FROM productos p 
            INNER JOIN categorias c ON p.categoria_id = c.id_categoria 
            WHERE c.id_categoria = '$id_categoria'";

        $productos = $this->selectAll($sql);

        foreach ($productos as &$producto) {
            $producto['precio_producto'] = number_format($producto['precio_producto'], 0, ',', '.');
        }

        return $productos;
    }

    public function getAleatorios($id_categoria)
    {
        $sql = "SELECT * FROM productos 
            WHERE categoria_id = '$id_categoria' 
            ORDER BY RAND() 
            LIMIT 8";

        $productos = $this->selectAll($sql);

        foreach ($productos as &$producto) {
            $producto['precio_producto'] = number_format($producto['precio_producto'], 0, ',', '.');
        }

        return $productos;
    }
    public function getTodasLasCategorias()
    {
        $sql = "SELECT * FROM categorias ORDER BY nombre_categoria";
        return $this->selectAll($sql);
    }

}
