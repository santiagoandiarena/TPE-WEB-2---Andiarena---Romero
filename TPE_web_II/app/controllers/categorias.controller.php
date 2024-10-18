<?php
require_once 'app/models/categorias.model.php';
require_once 'app/views/categorias.view.php';

class CategoriasController
{

    private $model;
    private $view;



    function __construct()
    {
        $this->model = new obtenercategorias();
        $this->view = new CategoriasVista();
    }
    function mostrarcategorias()
    {
        //obteiene las categorias.

        $categorias = $this->model->obtenercategorias();
        $this->view->mostrarcategorias($categorias);

    }
    function productosxcategorias($id)
    {

        $productos = $this->model->productosxcategorias($id);
        $this->view->productosxcategorias($productos);


    }

    function agregarcategorias()
    {
        $nombre = $_POST['nombre'];
        
        if (empty($nombre) ) {
            echo "no estan todos los datos";
        } else {
            $this->model->agregarcategorias($nombre);
            header("Location:" . BASE_URL . "agregarcategorias");

        }

    }
    function vercategoriasagregadas()
    {

        $categorias = $this->model->obtenercategorias();

        $this->view->agregarcategorias($categorias);
    }

    function editarcategorias($id)
    {
        $nombre = $_POST['nombre'];
    
        if (empty($nombre) ) {
            echo "no estan todos los datos";
        } else {
            $this->model->editarcategorias($nombre, $id);
            header("Location:" . BASE_URL . "home");

        }
    }

    function borrarcategoria($id)
    {
        $this->model->borrarcategoria($id);
        header("Location:" . BASE_URL . "agregarcategorias");
    }


}
