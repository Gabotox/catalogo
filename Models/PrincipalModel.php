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
}
