<?php

    namespace controllers;

    require_once __DIR__ . '/../models/Reserva.php';
    require_once __DIR__ . '/../models/Quadra.php';

    use DbConfig;

    use Exception;

    use models\Cliente;

    use models\Quadra;

    use models\Reserva;

    class ReservaController{

        public static function index(){

            // Quadra::criarQuadrasDb();

            Header("Location: /PHP_A2/tests/testeMain.php");

        }

        public static function criarReserva(){

            if($_SERVER['REQUEST_METHOD'] == "GET"){

                $idHorario = $_GET['idHorario'] ?? null;
                $idCliente = $_GET['idCliente'] ?? null;
                $idQuadra = $_GET['idQuadra'] ?? null;

            

                try{

                    Reserva::criarReserva($idHorario, $idCliente, $idQuadra);

                    

                } catch (Exception $exception){

                    echo "erro: " . $exception->getMessage() . "<br>";
                    echo 
                    "erro ao criar reserva";

                }
            }
        }

        public static function marcarReserva(){

            if($_SERVER['REQUEST_METHOD'] == "POST"){

                $nome = $_POST['clienteNome'];
                $cpf = $_POST['clienteCpf'];
                $telefone = $_POST['clienteTelefone'];
                $data = $_POST['reservaData'];
                $quadraId = $_POST['quadraId'];
                
                try{

                    $cliente = new Cliente($nome, $cpf, $telefone);
                    
                    Reserva::marcarReserva($cliente, $data, $quadraId);

                    Header("Location: /PHP_A2/tests/testReservaConfirmada.php");
                    die;

                } catch (Exception $exception){

                    echo "erro: " . $exception->getMessage() . "<br>";

                }
            }
        }

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