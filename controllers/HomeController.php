<?php
    class HomeController{

    public static function home() {
        session_start();
        include_once __DIR__ . '/../views/home.php';
    }    

    public static function login() {
        require_once __DIR__ . '/../models/Usuario.php';
        require_once __DIR__ . '/../DbConfig.php';
        require_once __DIR__ . '/../Validador.php';

        session_start();

        if(isset($_SESSION['user_id'])) {
            header("Location: fornecedores");
            exit;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario = $_POST['username'] ?? null;
            $senha = $_POST['password'] ?? null;
            $cpf = $_POST['cpf'] ?? null;
            $dataNascimento = $_POST['data_nascimento'] ?? null;
            $passwordHash = password_hash($senha, PASSWORD_DEFAULT);
            
            $erros = [];            

            if (!Validador::validarCPF($cpf)) {
                $erros[] = "CPF inválido";
            }
            if (!Validador::validarDataNascimento($dataNascimento)) {
                $erros[] = "Data de nascimento inválida";
            }
            if (empty($erros)) {
                $cpfFormatado = Validador::formatarCPF($cpf);
                $dataFormatada = Validador::formatarData($dataNascimento);
                echo "CPF: $cpfFormatado<br>";
                echo "Data: $dataFormatada<br>";
            } else {
                foreach ($erros as $erro) {
                    echo $erro . "<br>";
                }
            }
            
            if(empty($usuario) || empty($senha)) {
                echo "Preencha todos os campos";
            } else {
                if(Usuario::autenticador($usuario, $senha)){
                    header("Location: fornecedores");
                    exit;
                } else {
                    echo "Usuário ou senha inválidos";
                }
            }

        }
        
        require __DIR__ . '/../views/login.php';
    }

    public static function logout() {
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['user']);
        session_destroy();
        
        header('Location: login');
        exit;
    }
}


?>