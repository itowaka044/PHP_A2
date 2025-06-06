<?php

use controllers\ReservaController;
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/ReservaController.php';
require_once __DIR__ . '/models/Cliente.php';
require_once __DIR__ . '/models/Reserva.php';
require_once __DIR__ . '/DbConfig.php';

$uri = $_SERVER['REQUEST_URI'];

$urlBase = '/PHP_A2'; 

$urlAlterado = str_replace($urlBase, '', parse_url($uri, PHP_URL_PATH));

$pagina = trim($urlAlterado, '/');

// echo $uri . "<br>";
// echo $urlBase . "<br>";
// echo $urlAlterado . "<br>";
// echo var_dump($pagina);
// die;

match($pagina){
    'login'     => HomeController::login(),
    'logout'    => HomeController::logout(),

    'reserva'    => ReservaController::index(),
    'reserva/marcar'  => ReservaController::marcarReserva(),
    'reserva/consultar' => ReservaController::consultarReserva(),
    'reserva/desmarcar' => ReservaController::desmarcarReserva(),
    'reserva/editar'    => ReservaController::editarReserva(),

    '' => ReservaController::index(),

    default => ReservaController::index()
};

?>