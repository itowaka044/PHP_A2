<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['nomeUsuario'])){
        Header("Location: /PHP_A2/views/selecionar.php");
        die;
    }

?>

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