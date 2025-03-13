<?php
class Principal extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function detail($id_producto)
    {
        $data['producto'] = $this->model->getProducto($id_producto);
        $id_categoria = $data['producto']['categoria_id'];
        $data['relacionados'] = $this->model->getAleatorios($id_categoria);
        $data['title'] = $data['producto']['nombre_producto'];
        $this->views->getView('principal', "detail", $data);
    }
    public function categoria($id_categoria) {
        $data['categoria'] = $this->model->getCategoria($id_categoria);
        $data['title'] = $data['categoria'][0]['nombre_categoria'];
        $this->views->getView('principal', "categoria", $data);
    }

    

}
