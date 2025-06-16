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

            Header("Location: /PHP_A2/views/logar.php");

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

        // public static function marcarReserva(){

        //     if($_SERVER['REQUEST_METHOD'] == "POST"){

        //         $nome = $_POST['clienteNome'];
        //         $cpf = $_POST['clienteCpf'];
        //         $telefone = $_POST['clienteTelefone'];
        //         $data = $_POST['reservaData'];
        //         $quadraId = $_POST['quadraId'];
                
        //         try{

        //             $cliente = new Cliente($nome, $cpf, $telefone);
                    
        //             Reserva::marcarReserva($cliente, $data, $quadraId);

        //             Header("Location: /PHP_A2/tests/testReservaConfirmada.php");
        //             die;

        //         } catch (Exception $exception){

        //             echo "erro: " . $exception->getMessage() . "<br>";

        //         }
        //     }
        // }

        public static function consultarReservas(){

            try{
                $reservas = Reserva::consultarReserva();

                return $reservas;

            } catch(Exception $exception){
                echo "erro: ". $exception->getMessage() . "<br>";
            }
        }
        public static function consultarReservaPorId(){
            try {
                if (!isset($_GET['id'])) {
                    echo "ID da reserva não informado.";
                    return;
                }

                $id = $_GET['id'];

                $reserva = Reserva::consultarReservaPorId($id);

                if ($reserva) {
                    include '/tests/testReservaPorId.php';
                } else {
                    echo "Reserva não encontrada.";
                }
            } catch (Exception $exception) {
                echo "erro: " . $exception->getMessage() . "<br>";
            }
        }

        public static function consultarQuadra($id){

            // try{

            //     $ = Reserva::consultarQuadra($id);



            // }


        }

        public static function desmarcarReserva(){

        }

        public static function editarReserva(){
            
        }

    }

?>