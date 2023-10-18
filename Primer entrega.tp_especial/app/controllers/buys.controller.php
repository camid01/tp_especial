<?php
require_once './app/models/buys.model.php';
require_once './app/views/buys.view.php';
require_once './app/helpers/auth.helper.php';

class buysController{
    private $model;
    private $view;
    private $auth;

    public function __construct() {
        $this->model = new buysModel();
        $this->view = new buysView();
        $this->auth = new AuthHelper();
    }

    public function showHome(){
        
        $this->auth->verify();
        $this->view->showHome();
    }

    public function showBuys() {
        // obtengo tareas del controlador
        $customers = $this->model->getCustomers();
        
        // muestro las tareas desde la vista
        $this->view->showCustomers($customers);
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

    }
    public function modificarCompra($id_modificar){
        $compra= $this->model->obtenerCompraPorId($id_modificar); 
        $this->view->showFormEditar($compra);
    }

    public function editarCompra($id_modificar){
        $mensaje = $_POST['mensaje']; 
        $total = $_POST['total']; 
        $mensajeEditado = $this->model->compraEditada($id_modificar, $mensaje, $total); 
        if($mensajeEditado > 0 ){
            header('Location: ' . BASE_URL. 'ampliar/'. $id_modificar);
        }else{
            $this->view->showError("Ocurrió un error durante la inserción"); 
        }
    }
}