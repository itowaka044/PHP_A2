<?php

namespace models;

require_once __DIR__ . "/../DbConfig.php";

use Exception;
use models\Cliente;

use PDO;

use DbConfig;

class Reserva{
  

    public function __construct(){
    }

        public static function criarReserva($idHorario, $idUsuario, $idQuadra){
        $db = Dbconfig::getConn();

        try{

            $testeStatement = $db->prepare(
                "select h.idHorario
                from horario h
                
                left join 
                reserva r on h.idHorario = r.idHorario and r.statusReserva
                where h.idHorario = :idHorario and r.idReserva is null"
            );

            $testeStatement->bindParam(":idHorario" , $idHorario, PDO::PARAM_INT);
            $testeStatement->execute();

            if($testeStatement->rowCount() == 0){
                echo "sem horarios para exibir";
                return false;
            }

            $statement = $db->prepare(
                "insert into reserva(idHorario, idUsuario, dataReserva, statusReserva, idQuadra)
                values (:idHorario, :idUsuario, :dataReserva, :statusReserva, :idQuadra)"
            );

            $reservouEm = date("Y-m-d");

            $status = false;

            $statement->bindParam(':idHorario', $idHorario, PDO::PARAM_INT);
            $statement->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $statement->bindParam(':dataReserva', $reservouEm, PDO::PARAM_STR);
            $statement->bindParam(':statusReserva', $status, PDO::PARAM_BOOL);
            $statement->bindParam(":idQuadra", $idQuadra, PDO::PARAM_INT);

            return $statement->execute();

        }catch(Exception $ex){
            echo "erro: " . $ex->getMessage() . "<br>";
            return false;
        }

    }

    private static function reservarQuadra($idQuadra){

        $db = DbConfig::getConn();

        $statement = $db->prepare("update reservado set reservado = true where quadraId = :id");

        $statement->bindParam(":id", $idQuadra, PDO::PARAM_INT);

    }

    private static function quadraEstaReservada($quadraId){

        $db = DbConfig::getConn();

        $statement = $db->prepare("select reservado from quadra where quadraId = :id");

        $statement->bindParam(":id", $quadraId, PDO::PARAM_INT);

        return $statement;
    }

    public static function consultarReserva(){

        $db = DbConfig::getConn();
        
        $statement = $db->query("select * from reservas");

        return $statement->fetchAll();
    }

    public static function consultarReservaPorId($id){

        $db = DbConfig::getConn();

        $statement = $db->prepare("select * from reservas where clienteId = :id");

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        
        $statement->execute();

        return $statement->fetch();

    }

    public static function consultarQuadras($id){

        $db = DbConfig::getConn();

        $statement = $db->prepare("select * from quadra where quadraId = :id");

        $statement->bindparam(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetch();

    }

    public function editarReserva(){

        return;
    }

    public function desmarcarReserva($id){
        $db = DbConfig::getConn();
        return $db->query("delete from reserva where id='$id')");
    }

}

?>