<?php

    include_once __DIR__ . '/includes/header.php';

    require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
    require_once "C:\\xampp\htdocs\PHP_A2\controllers\ReservaController.php";

    use controllers\ReservaController;

    if(!isset($_SESSION)){
        session_start();
    }

    ReservaController::criarReserva();


?>


<div id="reservado">
    <p>Reserva concluída, obrigado pela preferência!</p>
    <br>
    <br>
    <a href="home.php">Voltar para a Home</a>
</div>  