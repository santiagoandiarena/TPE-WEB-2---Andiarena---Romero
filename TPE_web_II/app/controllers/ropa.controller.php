<?php

require_once 'app/models/ropa.model.php';
require_once 'app/views/ropa.view.php';

class RopaController
{
    private $model;
    private $view;
    private $modelCategoria;

    public function __construct()
    {
        $this->model = new RopaModel();
        $this->view = new RopaView();
        $this->modelCategoria = new obtenercategorias();
    }

    //METODOS

    public function mostrarHome()
    {

        $prendas = $this->model->obtenerPrendas();
        $categorias = $this->modelCategoria->obtenercategorias();

        //$this->view->agregarArticulo($prendas, $categorias);
        $this->view->mostrarHome($prendas, $categorias);
    }

    public function administrarArticulos()
    {
        $prendas = $this->model->obtenerPrendas();
        $categorias = $this->modelCategoria->obtenercategorias();

        $this->view->administrarArticulos($prendas, $categorias);
    }

    public function mostrarProducto($id)
    {
        $prenda = $this->model->obtenerPrenda($id); // devuelve una única prenda
        $categorias = $this->modelCategoria->obtenercategorias();

        $this->view->mostrarProducto($prenda, $categorias); // Pasa la primera (y única) prenda
    }

    public function agregararticulo()
    {
        $nombre = $_POST['nombre'];
        $valor = $_POST['valor'];
        $descripcion = $_POST['descripcion'];
        $ID_categoria = $_POST['categoria']; // Obtén la categoría seleccionada
        $imagen = $_POST['imagen']; // Recibe la URL de la imagen

        if (empty($nombre) || empty($valor) || empty($descripcion) || empty($ID_categoria) || empty($imagen)) {
            echo "No están todos los datos";
        } else {
            // Opcional: Validar que $imagen sea una URL válida
            if (!filter_var($imagen, FILTER_VALIDATE_URL)) {
                echo "La URL de la imagen no es válida.";
                return;
            }

            $this->model->agregararticulo($nombre, $valor, $descripcion, $ID_categoria, $imagen);
            header("Location:" . BASE_URL . "home");
        }
    }


    public function eliminarArticulo($id)
    {
        // obtengo la tarea por id
        $prenda = $this->model->obtenerPrenda($id);

        if (!$prenda) {
            return $this->view->mostrarError("No existe la tarea con el id= $id");
        }

        // borro la tarea y redirijo
        $this->model->eliminarPrenda($id);

        header('Location: ' . BASE_URL);
    }

    function mostrarFormEdicion($id)
    {
        $prenda =  $this->model->obtenerPrenda($id);
        $categorias = $this->modelCategoria->obtenercategorias();
        $this->view->editarArticulo($prenda, $categorias);
    }

    function editarArticulo($id)
    {

        $nombre = $_POST['nombre'];
        $valor = $_POST['valor'];
        $descripcion = $_POST['descripcion'];
        $ID_categoria = $_POST['categoria']; // Obtén la categoría seleccionada del formulario
        $imagen = $_POST['imagen']; // Recibe la URL de la imagen

        if (empty($nombre) || empty($valor) || empty($descripcion) || empty($ID_categoria) || empty($imagen)) {
            echo "Todos los campos son obligatorios.";
        } else if ($valor < 0) {
            echo "El valor tiene que ser positivo";
        } else {
            // Validar que $imagen sea una URL válida
            if (!filter_var($imagen, FILTER_VALIDATE_URL)) {
                echo "La URL de la imagen no es válida.";
                return;
            }

            // Asegúrate de que la categoría también se actualice en la base de datos
            $this->model->editarArticulo($nombre, $valor, $descripcion, $ID_categoria, $imagen, $id);

            header("Location: " . BASE_URL . "home");
        }
    }



    public function mostrarNosotros()
    {
        $this->view->mostrarNosotros();
    }

    public function mostrarError($error)
    {
        $this->view->mostrarError($error);
    }
}
