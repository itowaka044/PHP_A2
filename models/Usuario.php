<?php 

namespace models;
use DbConfig;
use PDO;
use Exception;

require_once __DIR__ . '/../Dbconfig.php';

class Usuario {

    public static function buscarUsuario($nomeUsuario){

        $db = DbConfig::getConn();

        try{

            $statement = $db->prepare("select * from usuario where nomeUsuario = :nome");
            $statement->bindParam(":nome", $nomeUsuario, PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetch();
            

        } catch(Exception $ex) {
            echo "erro: " . $ex->getMessage() . "<br>";
            return false;
        }
    }

    public static function cadastrarUsuario($usuario, $senhaHash, $cpf, $dataNascimento, $telefone) {
        try {
            $db = DbConfig::getConn();
            
            $stmt = $db->prepare("INSERT INTO usuario (nomeUsuario, senhaUsuario, cpfUsuario, dataNascimento, telefoneUsuario) 
                VALUES (:usuario, :senha, :cpf, :dataNascimento, :tel)");
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $stmt->bindParam(':dataNascimento', $dataNascimento, PDO::PARAM_STR);
            $stmt->bindParam(':tel', $telefone , PDO::PARAM_STR);
            
            if (!$stmt->execute()) {
                throw new Exception("erro ao cadastrar");
            }
            return true;

        } catch (Exception $ex) {

            echo "erro: " . $ex->getMessage() . "<br>";
        }
    }

    public static function fazerLogin($usuario, $senha){

    }
}
?>