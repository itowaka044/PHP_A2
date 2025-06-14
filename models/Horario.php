<?php


namespace models;

require_once "C:\\xampp\htdocs\PHP_A2\DbConfig.php";

use DateTime;
use models\Quadra;
use models\Reserva;
use Exception;
use DbConfig;
use PDO;

class Horario{

    public int $idHorario;
    public int $idQuadra;
    public string $dataHorario;
    public string $horaInicio;
    public string $horaFim;
    public bool $statusDisp;


    public static function gerarHorarios($idQuadra, $diaInicioParam, $diaFimParam, $horaInicioParam, $horaFimParam){

        $horariosGerados = 0;

        $db = DbConfig::getConn();
        
        try{

            $db->beginTransaction();

            $diaInicio = new DateTime($diaInicioParam);
            $diaFim = new DateTime($diaFimParam);
            $diaFim->setTime(23,59,59);

            while($diaInicio <= $diaFim){

                $horaAtual = $diaInicio->format("Y-m-d");
                $horaInicioDiaria = new DateTime($horaAtual . " " . $horaInicioParam);
                $horaFimDiaria = new DateTime($horaAtual . " " . $horaFimParam);

                while($horaInicioDiaria < $horaFimDiaria){

                    $horaInicio = $horaInicioDiaria->format(format: "H:i:s");

                    $ultimoSlot = clone $horaInicioDiaria;
                    $ultimoSlot->modify("+" . 60 . " minutes");

                    $horaFim = $ultimoSlot->format("H:i:s");

                    if($ultimoSlot > $horaFimDiaria && $horaFim != $horaFimDiaria){
                        break;
                    }

                    if($horaInicioDiaria == $horaFimDiaria){
                        break;
                    }

                    $statement = $db->prepare("insert into horario (idQuadra, dataHorario, horaInicio, horaFim) values
                    (:idQuadra, :dataHorario, :horaInicio, :horaFim)");

                    $statement->bindParam("idQuadra", $idQuadra, PDO::PARAM_INT);
                    $statement->bindParam(":dataHorario",$horaAtual, PDO::PARAM_STR);
                    $statement->bindParam(":horaInicio", $horaInicio, PDO::PARAM_STR);
                    $statement->bindParam(":horaFim", $horaFim, PDO::PARAM_STR);

                    if($statement->execute()){
                        $horariosGerados++;
                    } else {
                        $db->rollBack();
                        return 0;
                    }

                    $horaInicioDiaria->modify("+" . 60 . " minutes");

                }

                $diaInicio->modify('+1 day');

            }

            $db->commit();

            return $horariosGerados;


        }catch(Exception $ex){
            echo "erro: " . $ex->getMessage() . "<br>";
            return 0;
        }

    }

}

?>