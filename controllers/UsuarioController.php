<?php

namespace controllers;

require_once "C:\\xampp\htdocs\PHP_A2\models\Usuario.php";
use Exception;
use models\Usuario;
require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
use security\CsrfToken;
class UsuarioController{

    public static function cadastrarUsuario(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $tokenAux = $_POST[CsrfToken::campoOculto] ?? '';
            if (!CsrfToken::validar($tokenAux)) {

                echo "erro ao validar token";

                Header('Location: C:\xampp\htdocs\PHP_A2\views\index.php');
                die();
            }

            $usuario = $_POST['nomeUsuario'];
            $senha = $_POST['senhaUsuario'];

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $cpf = $_POST['cpfUsuario'];
            $email = $_POST['emailUsuario'];
            $telefone = $_POST['telefoneUsuario'];

            try{

                $sucesso = Usuario::cadastrarUsuario($usuario, $senhaHash, $cpf, $email, $telefone);

                if($sucesso){

                    Header("Location: /PHP_A2/views/logar.php");
                    die();

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

        $tokenAux = $_POST[CsrfToken::campoOculto] ?? '';
        if (!CsrfToken::validar($tokenAux)) {

            echo "erro ao validar token";

            Header('Location: C:\xampp\htdocs\PHP_A2\views\index.php');
            die();
        }

        $nomeUsuario = $_POST['nomeUsuario'] ?? "";
        $senhaUsuario = $_POST['senhaUsuario'] ?? "";

        if(empty($nomeUsuario) || empty($senhaUsuario)){

            echo "insira os dados corretamente";
            return;
        }
        try{

            $usuario = Usuario::buscarUsuario($nomeUsuario);

            if(!$usuario){
                $usuario["senhaUsuario"] = null;
            }

        }catch(Exception $ex){

            echo "erro: " . $ex->getMessage() . "<br>"; 
            return;
        }
        if(password_verify($senhaUsuario, $usuario["senhaUsuario"])){

            $_SESSION['idUsuario'] = $usuario["idUsuario"];
            $_SESSION['nomeUsuario'] = $usuario['nomeUsuario'];

            Header("Location: /PHP_A2/views/selecionar.php");

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

        echo "logout realizado";

        die();

    }

    public static function resetarSenha(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $tokenAux = $_POST[CsrfToken::campoOculto] ?? '';
            if (!CsrfToken::validar($tokenAux)) {

                echo "erro ao validar token";

                Header('Location: C:\xampp\htdocs\PHP_A2\views\index.php');
                die();
            }

            $cpf = $_POST['cpfRecup'];
            $email = $_POST['emailRecup'];
            $usuario = $_POST['usuarioRecup'];
            $novaSenha = $_POST['novaSenha'];

            $senhaHash =  password_hash($novaSenha, PASSWORD_DEFAULT);

        try{

            Usuario::resetarSenha($usuario, $cpf, $email, $senhaHash);

        } catch(Exception $ex){
            echo "erro: " . $ex->getMessage() . "<br>";
        }




        }
    }
}

?>