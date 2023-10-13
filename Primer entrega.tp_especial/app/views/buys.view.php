<?php

class buysView {
    
    public function showHome(){
        require 'templates/header.phtml';
        echo '<h1>Aca va el home</h1>';
    }
    
    public function showCustomers($customers) {
        require 'templates/header.phtml';
        ?>

        <ul>
            <h1>Lista de usuarios que realizaron compras en nuestra pagina</h1>
        <?php foreach($customers as $customer) { ?>
            <li>
                <?php echo $customer->Nombre?>
                <a href="ampliar/<?php echo $customer->id ?>" type="button" class='btn btn-danger ml-auto'>Detalle</a>
            </li>
        <?php } ?>
        </ul>

        <?php
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
}