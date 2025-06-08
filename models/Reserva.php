<?php

namespace models;

require_once __DIR__ . "/../DbConfig.php";

use models\Cliente;

use DbConfig;

class Reserva{

    public int $id;
    public Cliente $cliente;
    public string $data;

    public function __construct(Cliente $cliente, string $data){
        $this->cliente = $cliente;
        $this->data = $data;    
    }

    public static function marcarReserva(Cliente $cliente, string $data){
        $reserva = new Reserva($cliente, $data);

        $db = DbConfig::getConn();

        //var_dump($db);

        $statement = $db->prepare("insert into reservas(clienteNome, clienteCpf, clienteTelefone , reservaData) 
        values (:clienteNome, :clienteCpf, :clienteTelefone, :reservaData)");

        // var_dump($statement);
        // die;

        $statement->bindValue(":clienteNome", $reserva->cliente->nome);
        $statement->bindValue(":clienteCpf", $reserva->cliente->cpf);
        $statement->bindValue(":clienteTelefone", $reserva->cliente->telefone);
        $statement->bindValue(":reservaData", $data);

        return $statement->execute();
    }

    public static function consultarReserva(){

        $db = DbConfig::getConn();
        
        $reservas = $db->query("select * from reservas");

        return $reservas->fetchAll();
    }

    public static function consultarReservaPorId($id){

        $db = DbConfig::getConn();

        $statement = $db->prepare("select * from reservas where clienteId = :id");
        
        $statement->execute(['clienteId' => $id]);

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