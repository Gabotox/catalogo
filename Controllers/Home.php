<?php
class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {

        $data['title'] = 'Pagina Principal';
        $data['categorias'] = $this->model->getCategorias();
        $data['productos'] = $this->model->getProductos();
        $data['productosConCategoria'] = $this->model->getProductosConCategoria();
        $data['banners'] = $this->model->getBanners();
        $this->views->getView('home', "index", $data);
    }
}
