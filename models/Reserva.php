<?php

namespace models;

require_once __DIR__ . "/../DbConfig.php";

use models\Cliente;

use PDO;

use DbConfig;

class Reserva{

    public int $idReserva;
    
    public int $idCliente;

    public int $idHorario;

    public int $idQuadra;
    public string $dataReserva;
    public bool $statusReserva;
    

    public function __construct(Cliente $cliente, string $data){
        $this->cliente = $cliente;
        $this->data = $data;
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

   public static function marcarReserva(Cliente $cliente, string $data, $idQuadra){
       $reserva = new Reserva($cliente, $data);

       $db = DbConfig::getConn();

       //var_dump($db);

       $statement = $db->prepare("insert into reservas(clienteNome, clienteCpf, clienteTelefone , reservaData, quadraId) 
       values (:clienteNome, :clienteCpf, :clienteTelefone, :reservaData, :quadraId)");

       // var_dump($statement);
       // die;

       $statement->bindValue(":clienteNome", $reserva->cliente->nome);
       $statement->bindValue(":clienteCpf", $reserva->cliente->cpf);
       $statement->bindValue(":clienteTelefone", $reserva->cliente->telefone);
       $statement->bindValue(":reservaData", $data);
       $statement->bindValue(":quadraId", $idQuadra);


       $isReservada = self::quadraEstaReservada($idQuadra);

       if($isReservada){

           self::reservarQuadra($idQuadra);

           return $statement->execute();

       }

       return false;
    
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