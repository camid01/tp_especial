<?php

class buysView {
    
    public function showHome(){
        require_once 'templates/header.phtml';
        echo '<h1>Alimentos, nutrición, descanso y deporte</h1>
            <p>La alimentación saludable comienza con la elección de alimentos saludables. No necesita ser un chef para elaborar comidas nutritivas y saludables para el corazón que su familia adorará. Aprenda en qué debe fijarse en el supermercado, los restaurantes, el lugar de trabajo o en cualquier otra ocasión relacionada con la alimentación.</p>
            <img src="img/portada.jpeg" alt="">';
    }

    
    public function showCustomers($customers) {
        require_once 'templates/header.phtml';
        require_once 'templates/listaClientes.phtml';
    }

    public function showDetalle($description){
        echo '<h1>Detalle de esta compra: </h1>';
        echo '<p>Envio a: '.$description->Destino.'</p>';
        echo $description->Detalle.', total $'.$description->Total;
    }

    public function showError($error) {
        echo "
            <div class='alert alert-danger' role='alert'>
                $error
            </div> 
        ";
    }

    public function showFormAgregar($cliente){
        require_once 'templates/header.phtml';
        require_once 'templates/agregarCompra.phtml'; 

    }

    public function showFormEditar($compra){
        require_once 'templates/header.phtml';
        require_once 'templates/editarCompra.phtml'; 
    }
}