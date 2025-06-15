<?php

namespace controllers;

use Exception;
use models\Quadra;

class QuadraController{

    public static function mostrarQuadras(){

        try{

            $quadras = Quadra::mostrarQuadras();

            return $quadras;

        } catch(Exception $ex){

            echo "erro: " . $ex->getMessage() . "<br>";

        }

    }
    
    public static function mostrarQuadraPorId(){

        try{

            $id = $_GET["id"];

            $quadra = Quadra::mostrarQuadraPorId($id);

            return $quadra;

        } catch(Exception $ex){

            echo "erro: " . $ex->getMessage() . "<br>";
        }


    }
}

?>