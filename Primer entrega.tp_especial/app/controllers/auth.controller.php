<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';

class AuthController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showRegistro() {
        $this->view->showRegistro();
    }
    //ACA ESTOY INTENTANDO USAR EL MISMO FORM DEPENDIENDO EL ACTION QUE SE HAGA
    /*
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $action = $_POST['action'];
    
        if ($action === 'registrar') {
            // Lógica para registrar al usuario
            registro();
        } elseif ($action === 'auth') {
            // Lógica para looguear al usuario
            auth();
        }
    }
    */
    public function registro(){
        //guardo el usuario con la contraseña hasheada
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password)){
            $hash=password_hash($password, PASSWORD_BCRYPT);
            $this->model->saveUser($email,$hash);
            header('Location: ' . BASE_URL);
        }
        else{
            $this->view->showLogin('Faltan completar datos');
            return;
        }

    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // busco el usuario
        $user = $this->model->getByEmail($email);

        if (!empty($user) && password_verify($password, $user->password)) {
            // ACA LO AUTENTIQUE
            AuthHelper::login($user);
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }
    
    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }
}