<?php

namespace Cliente;

class Reserva{

    public int $id;
    public Cliente $cliente;
    public string $data;

    public function __construct(Cliente $cliente, string $data){
        $this->cliente = $cliente;
        $this->data = $data;    
    }

    public function marcarReservar(Cliente $cliente, string $data){
        $db = DB::getConn();
        $query = "insert into fornecedores(cliente, data) values ({$cliente}, {$data})";
        return $db->query($query);
    }

    public function consultarReserva(){

        $db = DB::getConn();
        return $banco->query("select * from reserva");
    }

    public function editarReserva(){

        return;
    }

    public function desmarcarReserva($id){
        $db = DB::getConn();
        return $db->query("delete from reserva where id='$id')");
    }

}




?>