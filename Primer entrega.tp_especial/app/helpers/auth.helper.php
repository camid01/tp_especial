<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {
        AuthHelper::init();
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_EMAIL'] = $user->email; 
    }

    public function logout() {
        AuthHelper::init();
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . '/login'); // Redirige a la página de inicio de sesión
        exit();
    }

    public static function verify() {
        AuthHelper::init();
        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
    }
}