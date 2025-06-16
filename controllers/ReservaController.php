<?php

    namespace controllers;

    require_once __DIR__ . '/../models/Reserva.php';
    require_once __DIR__ . '/../models/Quadra.php';
    require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
    use security\CsrfToken;

    use DbConfig;

    use Exception;

    use models\Cliente;

    use models\Quadra;

    use models\Reserva;

    class ReservaController{

        public static function index(){

            Header("Location: /PHP_A2/views/home.php");

        }

        public static function criarReserva(){

            if($_SERVER['REQUEST_METHOD'] == "GET"){
               
                $idHorario = $_GET['idHorario'] ?? null;
                $idUsuario = $_GET['idUsuario'] ?? null;
                $idQuadra = $_GET['idQuadra'] ?? null;


                try{

                    Reserva::criarReserva($idHorario, $idUsuario, $idQuadra);
                    

                } catch (Exception $exception){

                    echo "erro: " . $exception->getMessage() . "<br>";
                    echo 
                    "erro ao criar reserva";

                }
            }
        }

        public static function processarReserva(){

            if(!isset($_SESSION)){
                session_start();
            }

            $idUsuario = $_SESSION['idUsuario'];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $tokenAux = $_POST[CsrfToken::campoOculto] ?? '';
                if (!CsrfToken::validar($tokenAux)) {

                    echo "erro ao validar token";

                    Header('Location: C:\xampp\htdocs\PHP_A2\views\index.php');
                die();
                }

                $idHorario = $_POST['idHorario'] ?? null;
                $idQuadra = $_POST['idQuadra'];

                header("Location: /PHP_A2/views/reservado.php?idHorario=" . urlencode($idHorario) . "&idUsuario=" . urlencode($idUsuario) . "&idQuadra=" . urlencode($idQuadra) );
                die();
            
            } else {
                header('Location: /PHP_A2/views/selecionar.php');
                die();
            }

        }


    }

?>