<?php


class CategoriasVista {

    function MostrarCategorias($categorias){
        $count =count($categorias);
        require 'templates/mostrar.categorias.phtml';
    }



    function productosxcategorias($productos){
   
        $count =count($productos);
        require 'templates/productos.x.categoria.phtml';

        
    }

    function agregarcategorias($categorias){

        require 'templates/añadir.categorias.phtml';
    }

   
     }