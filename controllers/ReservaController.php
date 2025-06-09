<?php

    namespace controllers;

    require_once __DIR__ . '/../models/Reserva.php';

    use DbConfig;
    use Exception;
    use models\Cliente;
    use models\Reserva;
    class ReservaController{

        public static function index(){

            Header("Location: /PHP_A2/tests/testeMain.php");

        }

        public static function marcarReserva(){

            if($_SERVER['REQUEST_METHOD'] == "POST"){

                $nome = $_POST['clienteNome'];
                $cpf = $_POST['clienteCpf'];
                $telefone = $_POST['clienteTelefone'];
                $data = $_POST['reservaData'];
                
                try{

                    $cliente = new Cliente($nome, $cpf, $telefone);
                    
                    Reserva::marcarReserva($cliente, $data);

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

        public static function desmarcarReserva(){

        }

        public static function editarReserva(){
            
        }

    }

?>