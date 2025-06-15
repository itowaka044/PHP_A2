<?php

namespace controllers;

require_once "C:\\xampp\htdocs\PHP_A2\models\Usuario.php";
use Exception;
use models\Usuario;

class UsuarioController{

    public static function cadastrarUsuario(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $usuario = $_POST['nomeUsuario'];
            $senha = $_POST['senhaUsuario'];

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $cpf = $_POST['cpfUsuario'];
            $dataNasc = $_POST['dataNascimento'];
            $telefone = $_POST['telefoneUsuario'];

            try{

                $sucesso = Usuario::cadastrarUsuario($usuario, $senhaHash, $cpf, $dataNasc, $telefone);

                if($sucesso){

                    echo "sucesso";

                }

            }catch(Exception $ex){
                echo "erro: " . $ex->getMessage() . "<br>";
            }
        }

    }

    public static function fazerLogin(){

        if(!isset($_SESSION)){
            session_start();
        }

        require_once "C:\\xampp\htdocs\PHP_A2\\tests\\testeLogin.php";

        $nomeUsuario = $_POST['nomeUsuario'];
        $senhaUsuario = $_POST['senhaUsuario'];

        if(empty($nomeUsuario) || empty($senhaUsuario)){
            echo "insira os dados corretamente";

        }

        $usuario = Usuario::buscarUsuario($nomeUsuario);

        if($usuario && password_verify($senhaUsuario, $usuario["senhaUsuario"])){
            $_SESSION['idUsuario'] = $usuario["idUsuario"];
            $_SESSION['nomeUsuario'] = $usuario['nomeUsuario'];

            echo "logado com sucesso";

        } else{
            echo "dados invalidos";
        }

    }

    public static function fazerLogout(){
        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION = [];

        session_destroy();
        die;

    }

}


?>