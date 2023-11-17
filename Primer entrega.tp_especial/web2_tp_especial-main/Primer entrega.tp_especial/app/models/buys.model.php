<?php
    require_once 'app/models/deploy.model.php';

class buysModel extends Model{
    
    function getCustomers() {
        $query = $this->db->prepare('SELECT * FROM clientes');
        $query->execute();

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

    public function deleteCustomer($id){
        $query = $this->db->prepare('DELETE FROM clientes WHERE id = ? ');
        $query->execute([$id]);
    }
    /*public function obtenerCompraPorId($id_modificar){
        $query= $this->db->prepare("SELECT * FROM clientes WHERE id = ? ");
        $query->execute([$id_modificar]); 
        return $query->fetch(PDO::FETCH_OBJ);
    }*/
    public function usuarioEditado($nombre, $direccion, $id_modificar){
        $query = $this->db->prepare("UPDATE clientes SET Nombre = ?, Dirección = ? WHERE id = ? ");
        $query->execute([$nombre,$direccion,$id_modificar]);
        
        //return $this->db->lastInsertId(); 
        return $query->rowCount();
    }
}