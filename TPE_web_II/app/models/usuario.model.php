<?php

require_once 'app/models/model.php';


class UsuarioModel extends Model {
 
 
    public function obtenerUsuarioPorNombre($nombreUsuario) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombreUsuario = ?");
        $query->execute([$nombreUsuario]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}