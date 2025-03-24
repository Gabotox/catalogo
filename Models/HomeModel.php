<?php
class HomeModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias";
        return $this->selectAll($sql);
    }

    public function getProductos()
    {
        $sql = "SELECT * FROM productos ORDER BY id_producto DESC LIMIT 10";
        $productos = $this->selectAll($sql);

        // Formatear precios a COP
        foreach ($productos as &$producto) {
            $producto['precio_producto'] = number_format($producto['precio_producto'], 0, ',', '.');
        }

        return $productos;
    }


    public function getProductosConCategoria()
    {
        $sql = "SELECT p.*, c.nombre_categoria FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id_categoria";
        $productos = $this->selectAll($sql);

        // Formatear precios a COP
        foreach ($productos as &$producto) {
            $producto['precio_producto'] = number_format($producto['precio_producto'], 0, ',', '.');
        }

        return $productos;
    }


    public function getBanners()
    {
        $sql = "SELECT * FROM banners";
        return $this->selectAll($sql);
    }
}
