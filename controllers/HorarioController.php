<?php

    namespace controllers;

    require_once "C:\\xampp\htdocs\PHP_A2\models\Horario.php";

    use models\Horario;
    use Exception;

    class HorarioController{

        public static function gerarHorarios(){

            $idQuadra = 1;
            $diaInicio = '2025-06-01';
            $diaFim = '2025-06-02';
            $horaInicioDiaria = '09:00:00';
            $horaFimDiaria = '18:00:00';
            $intervaloMinutos = 60;

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

    }

?>