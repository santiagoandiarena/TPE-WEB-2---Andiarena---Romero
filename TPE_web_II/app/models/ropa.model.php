<?php
require_once 'app/models/model.php';


class RopaModel extends Model
{
    

    //METODOS

    public function obtenerPrendas()
    {
        $query = $this->db->prepare('SELECT articulo.*, categoria.nombre AS categoria_nombre FROM articulo JOIN categoria ON articulo.ID_categoria = categoria.ID_categoria');
        $query->execute();

        $prendas = $query->fetchAll(PDO::FETCH_OBJ);

        return $prendas;
    }


    public function obtenerPrenda($id)
    {
        $query = $this->db->prepare('
        SELECT articulo.*, categoria.nombre AS categoria_nombre 
        FROM articulo 
        JOIN categoria ON articulo.ID_categoria = categoria.ID_categoria 
        WHERE ID_articulo = ?
    ');
        $query->execute([$id]);

        $prenda = $query->fetch(PDO::FETCH_OBJ);

        return $prenda;
    }


    public function eliminarPrenda($id)
    {
        $query = $this->db->prepare('DELETE FROM articulo WHERE ID_articulo = ?');
        $query->execute([$id]);
    }

    function agregararticulo($nombre, $valor, $descripcion, $id,$imagen)
    {
        $query = $this->db->prepare('INSERT INTO articulo (nombre, valor, descripcion, ID_categoria, imagen) VALUES (?,?, ?, ?, ?)');
        $query->execute([$nombre, $valor, $descripcion, $id, $imagen]);

        return $this->db->lastInsertId();
    }

    public function editarArticulo($nombre, $valor, $descripcion, $id_categoria, $imagen, $id)
    {
        $query = $this->db->prepare("UPDATE articulo SET nombre = ?, valor = ?, descripcion = ?, ID_categoria = ? , Imagen = ? WHERE ID_articulo = ?");
        $query->execute([$nombre, $valor, $descripcion, $id_categoria, $imagen, $id]);
    }




}
