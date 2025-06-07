<?php

class DbConfig {
    private static $conn;

    public static function getConn() {
        if (!self::$conn) {

            $user = 'root';
            $pass = '';

            try {

                self::$conn = new PDO("mysql:host=localhost;port=3307;dbname=reservador_fut", $user, $pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (Exception $exception){

                echo "erro ao conectar ao banco " . $exception->getMessage();
                die;
            }
        }

        return self::$conn;
    }
}

?>