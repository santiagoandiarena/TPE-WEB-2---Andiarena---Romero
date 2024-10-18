<?php
class RopaView
{


    public function mostrarHome($prendas, $categorias)
    {
        $count = count($prendas);
        require 'templates/mostrar.productos.phtml';
    }

    public function mostrarNosotros()
    {
        require  'templates/mostrar.nosotros.phtml';
    }

    public function mostrarProducto($prenda, $categorias)
    {
        require 'templates/mostrar.producto.phtml';
    }

    public function agregarArticulo($articulo, $categorias){
        require 'templates/mostrar.productos.phtml';
    }

    public function editarArticulo($prenda,  $categorias){

        require 'templates/editar.articulo.phtml';
    }
    
    public function administrarArticulos($prendas, $categorias){
        require 'templates/administrar.articulos.phtml';
    }

    public function mostrarError($error) {
        require 'templates/error.phtml';
    }
}
?>
