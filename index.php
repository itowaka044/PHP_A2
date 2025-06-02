<?php

$url = $_GET['url'] ?? null;
$url = explode("/", $url);
$pagina =  $url[0];

if (isset($url[1])) {
    $pagina = "{$url[0]}/$url[1]";
}

require __DIR__ . '/controllers/HomeController.php';
require __DIR__ . '/controllers/ClienteController.php';
require __DIR__ . '/controllers/ReservaController.php';

match($pagina){
    'login'     => HomeController::login(),
    'logout'    => HomeController::logout(),

    'reserva'    => ReservaController::index(),
    'reserva/marcar'  => ReservaController::marcarReserva(),
    'reserva/consultar' => ReservaController::consultarReserva(),
    'reserva/desmarcar' => ReservaControler::desmarcarReserva(),
    'reserva/editar'    => ReservaController::editarReserva(),

    'cliente/cadastrar' => ClienteController::cadastrarCliente(),
    'cliente/apagarCliente' => ClienteController::apagarCliente(),

    default => ReservaController::index()
};

?>