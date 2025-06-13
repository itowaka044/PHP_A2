<?php

namespace models;

require_once __DIR__ . "/../DbConfig.php";

use models\Cliente;
use PDO;
use DbConfig;

class Reserva {

    public int $id;
    public Cliente $cliente;
    public string $data;
    public Quadra $quadra;

    public function __construct(Cliente $cliente, string $data) {
        $this->cliente = $cliente;
        $this->data = $data;
    }

    private static function reservarQuadra($quadraId) {
        $db = DbConfig::getConn();
        $statement = $db->prepare("UPDATE quadra SET reservado = false WHERE quadraId = :id");
        $statement->bindParam(":id", $quadraId, PDO::PARAM_INT);
        $statement->execute();
    }

    private static function quadraEstaReservada($quadraId) {
        $db = DbConfig::getConn();
        $statement = $db->prepare("SELECT reservado FROM quadra WHERE quadraId = :id");
        $statement->bindParam(":id", $quadraId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return isset($result['reservado']) && $result['reservado'];
    }

    public static function marcarReserva(Cliente $cliente, string $data, $quadraId) {
        $reserva = new Reserva($cliente, $data);
        $db = DbConfig::getConn();

        if (self::quadraEstaReservada($quadraId)) {
            // Quadra já está reservada, não pode reservar novamente
            return false;
        }

        $statement = $db->prepare("INSERT INTO reservas(clienteNome, clienteCpf, clienteTelefone, reservaData, quadraId) 
            VALUES (:clienteNome, :clienteCpf, :clienteTelefone, :reservaData, :quadraId)");

        $statement->bindValue(":clienteNome", $reserva->cliente->nome);
        $statement->bindValue(":clienteCpf", $reserva->cliente->cpf);
        $statement->bindValue(":clienteTelefone", $reserva->cliente->telefone);
        $statement->bindValue(":reservaData", $data);
        $statement->bindValue(":quadraId", $quadraId);

        $result = $statement->execute();

        if ($result) {
            self::reservarQuadra($quadraId);
            return true;
        }

        return false;
    }

    public static function consultarReserva() {
        $db = DbConfig::getConn();
        $reservas = $db->query("SELECT * FROM reservas");
        return $reservas->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function consultarReservaPorId($id) {
        $db = DbConfig::getConn();
        $statement = $db->prepare("SELECT * FROM reservas WHERE clienteId = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function editarReserva() {
        // Implementação futura
        return;
    }

    public function desmarcarReserva($id) {
        $db = DbConfig::getConn();
        return $db->query("DELETE FROM reservas WHERE id = '$id'");
    }
}

?>