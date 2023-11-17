<?php

class AuthView {
    public function showLogin($error = null) {
        require_once './templates/login.phtml';
    }

    public function showRegistro($error = null) {
        require_once './templates/registro.phtml';
    }

    public function logout(){
        require_once './templates/logout.phtml';
    }

    public function showHeader(){
        require_once './templates/header.phtml';
    }
}