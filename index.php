<?php

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/ReservaController.php';
require_once __DIR__ . '/models/Cliente.php';
require_once __DIR__ . '/models/Reserva.php';
require_once __DIR__ . '/DbConfig.php';

use controllers\ReservaController;
use controllers\HomeController;

$uri = $_SERVER['REQUEST_URI'];
$urlBase = '/PHP_A2'; 
$urlSeparada = parse_url($uri, PHP_URL_PATH);
$urlAlterado = str_replace($urlBase, '', $urlSeparada);
$pagina = trim($urlAlterado, '/');

// Descomente para depuração
// echo $uri . "<br>";
// echo $urlBase . "<br>";
// echo $urlAlterado . "<br>";
// echo var_dump($pagina);
// die;

// Roteamento
match($pagina) {

    // Página de testes
    'teste' => ReservaController::index(),

    // Página inicial
    '', 
    'home' => HomeController::home(),

    // Login/Logout
    'login' => HomeController::login(),
    'logout' => HomeController::logout(),

    // Funcionalidades de reserva
    'reserva/marcar'        => ReservaController::marcarReserva(),
    'reserva/consultar'     => ReservaController::consultarReservas(),
    'reserva/consultar-id'  => ReservaController::consultarReservaPorId(),
    'reserva/desmarcar'     => ReservaController::desmarcarReserva(),
    'reserva/editar'        => ReservaController::editarReserva(),

    // Rota padrão
    default => HomeController::home()
};

?>
