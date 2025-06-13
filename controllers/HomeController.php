<?php
    class HomeController{

    public static function login() {
        require_once __DIR__ . '/../models/Usuario.php';

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario = $_POST['username'] ?? null;
            $senha = $_POST['password'] ?? null;
            $passwordHash = password_hash($senha, PASSWORD_DEFAULT);
            session_start();


            if(!is_null($usuario) && !is_null($senha)){
                if(Usuario::autenticador($usuario, $senha)){
                    header("Location: fornecedores");
                }
            }

        }
        
        require __DIR__ . '/../views/login.php';
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user']);
        session_destroy();
        
        header('Location: login');
        exit;
    }
}


?>