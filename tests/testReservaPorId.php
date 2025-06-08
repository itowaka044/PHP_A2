<?php

namespace views;

require_once 'C:\xampp\htdocs\PHP_A2\controllers\ReservaController.php';

use controllers\ReservaController;

$id = $_GET['id'];

$reservaPorId = ReservaController::consultarReservaPorId($id);

if($reservaPorId){
    echo "id: " . $reserva['clienteId'] . "<br>";
    echo "nome: " . $reserva['clienteNome'] . "<br>";
    echo "telefone: " . $reserva['clienteTelefone'] . "<br>" ;
    echo "data da reserva: " . $reserva['reservaData'] . "<br><br>";
} else {
    echo "reserva não encontrada";
}

?>