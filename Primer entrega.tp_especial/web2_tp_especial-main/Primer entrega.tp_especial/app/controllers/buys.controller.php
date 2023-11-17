<?php
require_once './app/models/buys.model.php';
require_once './app/views/buys.view.php';
require_once './app/helpers/auth.helper.php';

class buysController{
    private $model;
    private $view;
    private $auth;
    protected $usuario;

    public function __construct() {
        $this->model = new buysModel();
        $this->view = new buysView();
        $this->auth = new AuthHelper();
        $this->setUsuario();
    }

    public function setUsuario(){
        session_start();
        if(isset($_SESSION['USER_ID'])){
            $this->usuario = $_SESSION['USER_ID'];
        }
    }

    public function showHome(){
        
        $this->auth->verify(); 
        $this->view->showHome();
    }

    public function showBuys() {
        // obtengo tareas del controlador
        $customers = $this->model->getCustomers();
        $this->view->showCustomers($customers,$this->usuario);
        
    }

    public function descriptionBuys($id){
        $description = $this->model->getDetalle($id);

        $this->view->showDetalle($description); 
    }
    public function nuevaCompra($id_usuario){
        //$clientes = $this->model->getCustomers();
        $cliente = $this->model->obtenerClientePorId($id_usuario); 
        $this->view->showFormAgregar($cliente); 
    }
    public function insertarNuevaCompra($id_usuario){
        $total = $_POST['total'];  
        $direccion = $_POST['direccion']; 
        $mensaje = $_POST['mensaje']; 

        $compraInsertada = $this->model->newBuy($id_usuario, $direccion, $mensaje, $total); 
        if($compraInsertada > 0){
            header('Location: ' . BASE_URL);
        }else{
            $this->view->showError("Ocurrió un error durante la inserción"); 
        }
    }

    public function borrarCompra($id_borrar){
        $this->model->deleteCustomer($id_borrar);
        header('Location: ' . BASE_URL . 'listar');
    }
    public function modificarCliente($id_modificar){
        $cliente = $this->model->obtenerClientePorId($id_modificar); 
        $this->view->showFormEditar($cliente);
    }

    public function editarCliente($id_modificar){
        $nombre = $_POST['nombre']; 
        $direccion = $_POST['direccion']; 
        $usuarioEditado = $this->model->usuarioEditado($nombre, $direccion, $id_modificar); 
        if($usuarioEditado){
            header('Location: ' . BASE_URL. 'listar');
        }else{
            $this->view->showError("Ocurrió un error durante la inserción"); 
        }
    }
}