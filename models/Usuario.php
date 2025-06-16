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

            return $statement->fetch(PDO::FETCH_ASSOC);
            

        } catch(Exception $ex) {
            echo "erro: " . $ex->getMessage() . "<br>";
            return false;
        }
    }

    public static function cadastrarUsuario($usuario, $senhaHash, $cpf, $email, $telefone) {

        try {

            $db = DbConfig::getConn();
            
            $statement = $db->prepare("INSERT INTO usuario (nomeUsuario, senhaUsuario, cpfUsuario, emailUsuario, telefoneUsuario) 
                VALUES (:usuario, :senha, :cpf, :email, :tel)");

            $statement->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $statement->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
            $statement->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':tel', $telefone , PDO::PARAM_STR);
            
            if (!$statement->execute()) {
                throw new Exception("erro ao cadastrar");
            }
            return true;

        } catch (Exception $ex) {

            echo "erro: " . $ex->getMessage() . "<br>";
        }
    }

    public static function resetarSenha($usuario, $cpf, $email, $novaSenha){
        $db = DbConfig::getConn();

        try{            

            $statement =  $db->prepare("update usuario set senhaUsuario = :novaSenha 
            where nomeUsuario = :usuario && cpfUsuario = :cpf  && emailUsuario = :email");

            $statement->bindParam(":usuario", $usuario , PDO::PARAM_STR);
            $statement->bindParam(":cpf", $cpf, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":novaSenha", $novaSenha, PDO::PARAM_STR);

            $statement->execute();

            echo "senha alterada";

        }catch(Exception $ex){
            echo "erro: " . $ex->getMessage() . "<br>";
        }
    }
}
?>