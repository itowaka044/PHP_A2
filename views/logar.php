<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['nomeUsuario'])){
        Header("Location: /PHP_A2/views/selecionar.php");
        die;
    }

?>
<h1>Login</h1>

<form method ="post" action="/PHP_A2/usuario/login">
    <p>Nome de usuário:</p>
    <input type="text" name="nomeUsuario" required>
    <br>

    <p>Senha:</p>
    <input type="password" name="senhaUsuario" required>
    <br>
    <br>
    <input type="submit">
    <br>
</form>

<br>

<a href="cadastrar.php">cadastrar</a>
<br>
<a href="resetarSenha.php">resetar senha</a>