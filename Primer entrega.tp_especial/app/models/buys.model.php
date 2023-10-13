<?php

class buysModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_alimentos_saludables;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas los productos.
     */
    function getCustomers() {
        $query = $this->db->prepare('SELECT * FROM clientes');
        $query->execute();

        // $tasks es un arreglo de tareas
        $customers = $query->fetchAll(PDO::FETCH_OBJ);

        return $customers;
    }

    function getDetalle($id){
        $query = $this->db->prepare('SELECT `Destino`, `Detalle`, `Total` FROM `compras` WHERE id_usuario = ?');
        $query->execute([$id]);

        $description = $query->fetch(PDO::FETCH_OBJ);
        
        return $description; 
    }
}