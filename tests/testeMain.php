<?php

namespace views;

require_once 'C:\xampp\htdocs\PHP_A2\controllers\ReservaController.php';

use controllers\ReservaController;


$reservas = ReservaController::consultarReservas();

foreach($reservas as $reserva){
    echo "id: " . $reserva['clienteId'] . "<br>";
    echo "nome: " . $reserva['clienteNome'] . "<br>";
    echo "telefone: " . $reserva['clienteTelefone'] . "<br>" ;
    echo "data da reserva: " . $reserva['reservaData'] . "<br><br>";
}

?>

<form action="http://localhost/PHP_A2/reserva/marcar" method="post">
    <br>
    <p>nome</p>
    <input type="text" name="clienteNome">
    <br>
    <p>cpf</p>
    <input type="text" name="clienteCpf">
    <br>
    <p>telefone</p>
    <input type="text" name="clienteTelefone">
    <br>
    <p>data</p>
    <input type="date" name="reservaData">
    <br><br>
    <input type="submit">
    <br><br>
</form>