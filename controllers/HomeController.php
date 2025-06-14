<?php
    class HomeController{


        
    public static function home() {
        session_start();
        include_once __DIR__ . '/../views/home.php';
    }    

    public static function cadastro() {
    require_once __DIR__ . '/../models/Usuario.php';
    require_once __DIR__ . '/../DbConfig.php';
    require_once __DIR__ . '/../Validador.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = $_POST['username'] ?? null;
        $senha = $_POST['password'] ?? null;
        $cpf = $_POST['cpf'] ?? null;
        $dataNascimento = $_POST['data_nascimento'] ?? null;
        
        $erros = [];
        
        if(empty($usuario) || empty($senha) || empty($cpf) || empty($dataNascimento)) {
            $erros[] = "Preencha todos os campos";
        }
        
        if (!Validador::validarCPF($cpf)) {
            $erros[] = "CPF inválido";
        }
        
        if (!Validador::validarDataNascimento($dataNascimento)) {
            $erros[] = "Data de nascimento inválida";
        }
        
        if(empty($erros)) {

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            if(Usuario::cadastrar($usuario, $senhaHash, $cpf, $dataNascimento)) {
                $_SESSION['success'] = "Usuário cadastrado com sucesso!";
                header("Location: login");
                exit;
            } else {
                $erros[] = "Erro ao cadastrar usuário";
            }
        }
        
        $_SESSION['cadastro_errors'] = $erros;
    }
    
    require __DIR__ . '/../views/cadastro.php';
}

    public static function login() {
        require_once __DIR__ . '/../models/Usuario.php';
        require_once __DIR__ . '/../DbConfig.php';
        
        session_start();
        
        if(isset($_SESSION['user_id'])) {
            header("Location: fornecedores");
            exit;
        }

        $erros = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = trim($_POST['username'] ?? null);
            $senha = $_POST['password'] ?? null;
            
            if(empty($usuario) || empty($senha)) {
                $erros[] = "Preencha todos os campos";
            } else {
                if(Usuario::autenticador($usuario, $senha)){
                    header("Location: fornecedores");
                    exit;
                } else {
                    $erros[] = "Usuário ou senha inválidos";
                }
            }
            
            $_SESSION['login_errors'] = $erros;
        }
        
        require __DIR__ . '/../views/login.php';
    }

    public static function logout() {
        session_start();

        $_SESSION = array();

        unset($_SESSION['user_id']);
        unset($_SESSION['user']);
        
        session_destroy();
        
        header('Location: home.php');
        exit;
    }
}


?>