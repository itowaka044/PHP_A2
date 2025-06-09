<?php

    class HomeController{

        public static function login(){

            require_once "DbConfig.php";
            session_start();

            // if(is_null($usuarioId)){

            //     if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //         $usuario_formulario = $_POST['usuario'] ?? null;
            //         $senha_formulario = $_POST['senha'] ?? null;
            //     }
            // }else{
            //     header("Location:/tests/testeMain.php");
            // }
        }

            public static function logout(){

                session_start();


                session_destroy();
                
                header("Location:");
            }
    }

?>