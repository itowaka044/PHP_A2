<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

require_once __DIR__ . '/controllers/ReservaController.php';
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
    'usuario/reset-senha' =>UsuarioController::resetarSenha(),
    'usuario/logout'    => UsuarioController::logout(),

    'horario/processar-horario' =>HorarioController::processarHorario(),
    'horario/consultar-disp' => HorarioController::consultarHorarioDisp(),

    'reserva/criar-reserva' => ReservaController::criarReserva(),
    'reserva/processar-reserva' => ReservaController::processarReserva(),

    '' => ReservaController::index(),

    default => ReservaController::index()
};

?>