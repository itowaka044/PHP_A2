<?php

namespace controllers;

class HomeController {

    public static function home() {
    session_start();
    include_once __DIR__ . '/../views/home.php';
}
    public static function login() {
        session_start();
        echo "Página de login (em construção)";
    }

    public static function logout() {
        session_start();
        session_destroy();
        header('Location: /PHP_A2');
        exit;
    }
}

?>
