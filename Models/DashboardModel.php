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
            ORDER BY p.id_producto
            LIMIT $inicio, $productosPorPagina"; // Agregamos el LIMIT

        $productos = $this->selectAll($sql);

        // Verifica si la consulta no falló
        if (!$productos) {
            return []; // Retorna un array vacío si no hay productos o hay un error
        }

        // Formatear precios a COP
        foreach ($productos as &$producto) {
            if (isset($producto['precio_producto'])) {
                $producto['precio_producto'] = number_format((float)$producto['precio_producto'], 0, ',', '.');
            }
        }
        unset($producto); // Rompe la referencia para evitar problemas

        return $productos;
    }

    public function contarCategorias()
    {
        $sql = "SELECT COUNT(*) as total FROM categorias";
        $resultado = $this->select($sql);

        // Si el resultado no es un array o no tiene la clave 'total', devuelve un array por defecto
        return is_array($resultado) && isset($resultado['total']) ? $resultado : ['total' => 0];
    }


    public function getCategorias($inicio, $categoriasPorPagina)
    {
        $sql = "SELECT * FROM categorias LIMIT $inicio, $categoriasPorPagina";
        return $this->selectAll($sql);
    }


    public function editarProducto($data)
    {

        // Pasamos los datos en el orden correcto
        $resultado = $this->insertar($sql, [
            $data["nombre"],
            $data["precio"],
            $data["descripcion"],
            $data["disponible"],
            $data["categoria"],
            $data["id"]
        ]);

        // Como `insertar()` devuelve lastInsertId() o 0, validamos si la actualización fue exitosa
        return $resultado !== 0; // Retorna `true` si hubo éxito, `false` en caso de error
    }
}
