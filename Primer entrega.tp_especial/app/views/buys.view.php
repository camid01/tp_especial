<?php

class buysView {
    
    public function showHome(){
        require 'templates/header.phtml';
        echo '<h1>Aca va el home</h1>';
    }
    
    public function showUsers($users) {
        require 'templates/header.phtml';
        ?>

        <ul>
            <h1>Lista de usuarios que realizaron compras en nuestra pagina</h1>
        <?php foreach($users as $user) { ?>
            <li>
                <?php echo $user->Nombre?>
                <a href="ampliar/<?php echo $user->id ?>" type="button" class='btn btn-danger ml-auto'>Detalle</a>
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