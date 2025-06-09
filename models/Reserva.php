<?php

namespace models;

require_once __DIR__ . "/../DbConfig.php";

use models\Cliente;

use PDO;

use DbConfig;

class Reserva{

    public int $id;
    public Cliente $cliente;
    public string $data;
    public Quadra $quadra;

    public function __construct(Cliente $cliente, string $data){
        $this->cliente = $cliente;
        $this->data = $data;
    }


    private function reservarQuadra($quadraId){

        $db = DbConfig::getConn();

        $statement = $db->prepare("update reservado set reservado = false where quadraId = :id");

        $statement->bindParam(":id", $quadraId, PDO::PARAM_INT);

    }

    private function quadraEstaReservada($quadraId){

        $db = DbConfig::getConn();

        $statement = $db->prepare("select reservado from quadra where quadraId = :id");

        $statement->bindParam(":id", $quadraId, PDO::PARAM_INT);

        return $statement;
    }

    public static function marcarReserva(Cliente $cliente, string $data, $quadraId){
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
        $statement->bindValue(":quadraId", $quadraId);


        $isReservada = $this->quadraEstaReservada($quadraId);

        if($isReservada){

            $this->reservarQuadra($quadraId);

            return $statement->execute();

        }

        return false;
        
    }

    public static function consultarReserva(){

        $db = DbConfig::getConn();
        
        $reservas = $db->query("select * from reservas");

        return $reservas->fetchAll();
    }

    public static function consultarReservaPorId($id){

        $db = DbConfig::getConn();

        $statement = $db->prepare("select * from reservas where clienteId = :id");

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        
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