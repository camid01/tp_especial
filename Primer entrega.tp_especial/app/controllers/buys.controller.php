<?php
require_once './app/models/buys.model.php';
require_once './app/views/buys.view.php';

class buysController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new buysModel();
        $this->view = new buysView();
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
}