<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<h1>Cadastro</h1>

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
    <input type="text" name="telefoneUsuario">
    <br>

    <p>Email:</p>
    <input type="text" name="emailUsuario">
    <br>

    <br>
    <input type="submit">


</form>