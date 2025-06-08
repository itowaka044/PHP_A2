<?php

namespace views;

require_once __DIR__ . '/controllers/ReservaController.php';

use controllers\ReservaController;


$reservas = ReservaController::consultarReservas();

foreach($reservas as $reserva){
    echo "id: " . $reserva['clienteId'] . "<br>";
    echo "nome: " . $reserva['clienteNome'] . "<br>";
    echo "telefone: " . $reserva['clienteTelefone'] . "<br>" ;
    echo "data da reserva: " . $reserva['reservaData'] . "<br><br>";
}

?>