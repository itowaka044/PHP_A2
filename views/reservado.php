<?php

    require_once "C:\\xampp\htdocs\PHP_A2\controllers\ReservaController.php";

    use controllers\ReservaController;

    if(!isset($_SESSION)){
        session_start();
    }

    ReservaController::criarReserva();


?>

<p>Reserva concluída, obrigado pela preferência!</p>