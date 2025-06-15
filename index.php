<?php

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/ReservaController.php';
require_once __DIR__ . '/models/Cliente.php';
require_once __DIR__ . '/models/Reserva.php';
require_once __DIR__ . '/DbConfig.php';
require_once __DIR__ . '/controllers/HorarioController.php';
require_once __DIR__ . '/controllers/UsuarioController.php';

use controllers\UsuarioController;
use controllers\HorarioController;
use controllers\ReservaController;

$uri = $_SERVER['REQUEST_URI'];

$urlBase = '/PHP_A2';

$urlSeparada = parse_url($uri, PHP_URL_PATH);

$urlAlterado = str_replace($urlBase, '', $urlSeparada);

$pagina = trim($urlAlterado, '/');

// echo $uri . "<br>";
// echo $urlBase . "<br>";
// echo $urlAlterado . "<br>";
// echo var_dump($pagina);
// die;

match($pagina){

    'teste'    => ReservaController::index(),

    'usuario/cadastrar' => UsuarioController::cadastrarUsuario(),
    'usuario/login'     => UsuarioController::fazerLogin(),
    
    'usuario/logout'    => UsuarioController::fazerLogout(),

    'reserva/consultar' => ReservaController::consultarReservas(),
    'reserva/consultar-id' => ReservaController::consultarReservaPorId(),
    'reserva/desmarcar' => ReservaController::desmarcarReserva(),
    'reserva/editar'    => ReservaController::editarReserva(),


    'horario/consultar-disp' => HorarioController::consultarHorarioDisp(),

    '' => ReservaController::index(),

    default => ReservaController::index()
};

?>