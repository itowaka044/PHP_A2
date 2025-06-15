<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<form action="/PHP_A2/usuario/cadastrar" method="post">

    <p>Nome de Usuário:</p>
    <input type="text" name="nomeUsuario">
    <br>

    <p>Senha:</p>
    <input type="text" name="senhaUsuario">
    <br>

    <p>CPF:</p>
    <input type="text" name="cpfUsuario">
    <br>

    <p>Telefone:</p>
    <input type="text" name="emailUsuario">
    <br>

    <p>Email:</p>
    <input type="text" name="telefoneUsuario">
    <br>

    <br>
    <input type="submit">


</form>