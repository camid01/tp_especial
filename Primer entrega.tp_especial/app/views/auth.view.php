<?php

class AuthView {
    public function showLogin($error = null) {
        require './templates/login.phtml';
    }

    public function showRegistro($error = null) {
        require './templates/registro.phtml';
    }
}