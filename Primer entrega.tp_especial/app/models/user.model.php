<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_alimentos_saludables;charset=utf8', 'root', '');
    }


    public function saveUser($email,$password){
        $query = $this->db->prepare('INSERT INTO `usuarios` (email, password) VALUES (? , ?)');
        $query->execute([$email,$password]);
        $query->fetch(PDO::FETCH_OBJ);
    }

    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        
        if (!$this->db) {
            die("Error en la conexión a la base de datos");
        }

        return $user;
    }

}