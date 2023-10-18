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
        $query = $this->db->prepare("SELECT `Destino`, `Detalle`, `Total` FROM `compras` WHERE id_usuario = ?");
        $query->execute([$id]);

        $description = $query->fetch(PDO::FETCH_OBJ);
        
        return $description; 
    }

    public function obtenerClientePorId($id_cliente){
        $query = $this->db->prepare("SELECT * FROM `clientes` WHERE id = ?");
        $query->execute([$id_cliente]);

        $cliente = $query->fetch(PDO::FETCH_OBJ);
        
        return $cliente; 
    }

    public function newBuy($id_usuario,$direccion, $mensaje, $total){
        $query = $this->db->prepare("INSERT INTO `compras`(`id_usuario`,`Destino`, `Detalle`, `Total`) VALUES (?,?,?,?)");
        $query->execute([$id_usuario,$direccion, $mensaje,$total]);
        
        //return $this->db->lastInsertId(); 
        return $query->rowCount();
        
    }

    public function deleteBuy(){
        
    }
    public function obtenerCompraPorId($id_modificar){
        $query= $this->db->prepare("SELECT * FROM `compras` WHERE id_usuario = ? ");
        $query->execute([$id_modificar]); 
        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function compraEditada($id_modificar, $mensaje, $total){
        $query = $this->db->prepare("UPDATE `compras` SET `Detalle`='?',`Total`='?' WHERE id_usuario = ? ");
        $query->execute([$mensaje,$total,$id_modificar]);
        
        //return $this->db->lastInsertId(); 
        return $query->rowCount();
    }
}