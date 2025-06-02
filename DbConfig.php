<?php

abstract class DbConfig {
    private static $conn;

    public static function getConn() {
        if (!isset(self::$conn)) {
            self::$conn = new mysqli("localhost:3307", "root", "", "reservador-fut");
            if (self::$conn->connect_error) {
                die("Erro ao conectar ao banco: " . self::$conn->connect_error);
            }
            self::$conn->set_charset("utf8mb4");
        }
        return self::$conn;
    }
}

?>