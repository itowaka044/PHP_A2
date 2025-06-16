<?php

    namespace controllers;

    require_once "C:\\xampp\htdocs\PHP_A2\models\Horario.php";

    require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
    use security\CsrfToken;

    use models\Horario;
    use Exception;

    class HorarioController{

        public static function gerarHorarios(){

            $idQuadra = 3;
            $diaInicio = '2025-06-01';
            $diaFim = '2025-06-30';
            $horaInicioDiaria = '09:00:00';
            $horaFimDiaria = '18:00:00';

            try{

            $horariosGerados = Horario::gerarHorarios($idQuadra, $diaInicio, $diaFim, $horaInicioDiaria, $horaFimDiaria);

            }catch(Exception $ex){
                echo "erro : " . $ex->getMessage() . "<br>";
            }

            if ($horariosGerados !== false) {
                echo "horarios gerados: " . $horariosGerados . " id da quadra: " . $idQuadra;
            } else {
                echo "erro ao gerar quadras.";
            }
        }

        public static function consultarHorarioDisp(){

            if($_SERVER['REQUEST_METHOD'] == "GET"){
                
                $idQuadra = $_GET['id'] ?? null;
                $dataHorario = $_GET['date'] ?? null;

                try{

                    $horariosDisp = Horario::consultarHorariosDisp($idQuadra, $dataHorario);

                    return $horariosDisp;

                }catch(Exception $ex){
                    echo "erro: " . $ex->getMessage() . "<br>";
                }
            }


        }

        public static function processarHorario(){

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $tokenAux = $_POST[CsrfToken::campoOculto] ?? '';
                if (!CsrfToken::validar($tokenAux)) {

                    echo "erro ao validar token";

                    Header('Location: C:\xampp\htdocs\PHP_A2\views\index.php');
                    die();
                }

                $idQuadra = $_POST['id'] ?? null;
                $dataHorario = $_POST['date'] ?? null;

                header("Location: /PHP_A2/views/horarios.php?id=" . urlencode($idQuadra) . "&date=" . urlencode($dataHorario));
                die();
            
            } else {
                header('Location: /PHP_A2/views/selecionar.php');
                die();
            }

        }
    }

?>