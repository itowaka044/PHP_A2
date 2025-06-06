<?php
    namespace controllers;

    use models\Cliente;
    use models\Reserva;
    class ReservaController{
        
        public static function index(){

            Header("Location: views/reserva.php");

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

                } catch (Exception $exception){

                    echo "erro: " . $exception->getMessage();

                }
            }
        }

        public static function consultarReserva(){

        }

        public static function desmarcarReserva(){

        }

        public static function editarReserva(){
            
        }

    }

?>