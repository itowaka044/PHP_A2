<?php 

require_once __DIR__ . '/../Dbconfig.php';

class Usuario {
    
    public static function autenticador($usuario, $senha) {
        try {
            $db = DbConfig::getConn();
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(empty($usuario) || empty($senha)) {
                header('Location: login');
            }

            $sql = "SELECT * FROM usuarios WHERE nome_usuario = :usuario LIMIT 1";
            $statement = $db->prepare($sql);
            $statement->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $statement->execute();

            $obj_usuario_resposta = $statement->fetch(PDO::FETCH_OBJ);

            if (!$obj_usuario_resposta) {
                return false;
            }

            if(password_verify($senha, $obj_usuario_resposta->senha)){
                    $_SESSION['user_id'] = $obj_usuario_resposta->id;
                    $_SESSION['user'] = $obj_usuario_resposta->nome_usuario;
                return true;
            }else{
                return false;
            }
            
        }
        catch (PDOException $e) {
            echo "Erro ao autenticar usuário: " . $e->getMessage();
            return false;
        }
    }

    public static function cadastrar($usuario, $senhaHash, $cpf, $dataNascimento) {
        try {
            $db = DbConfig::getConn();
            
            $sql = "INSERT INTO usuarios (nome_usuario, senha, cpf, data_nascimento) 
                    VALUES (:usuario, :senha, :cpf, :data_nascimento)";
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':senha', $senhaHash);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':data_nascimento', $dataNascimento);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
            return false;
        }
    }
}
?>
