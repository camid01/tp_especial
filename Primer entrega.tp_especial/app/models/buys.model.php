<?php

class buysModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_alimentos_saludables;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas los productos.
     */
    function getUsers() {
        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute();

        // $tasks es un arreglo de tareas
        $users = $query->fetchAll(PDO::FETCH_OBJ);

        return $users;
    }

    function getDetalle($id){
        $query = $this->db->prepare('SELECT `Destino`, `Detalle`, `Total` FROM `compra` WHERE id_usuario ='.$id);
        $query->execute();

        $description = $query->fetch(PDO::FETCH_OBJ);
        
        return $description; 
    }
}