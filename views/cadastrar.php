<?php
    if(!isset($_SESSION)){
        session_start();
    }

    include_once __DIR__ . '/includes/header.php';
?>
<div id="cadastro">
    <form action="/PHP_A2/usuario/cadastrar" method="post" id="">

        <?php
            require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
            use security\CsrfToken;
            echo CsrfToken::hiddenHtml();
        ?>

        <p>Nome de Usuário:</p>
        <input type="text" name="nomeUsuario">
        <br>
        <br>
        <p>Senha:</p>
        <input type="text" name="senhaUsuario">
        <br>
        <br>
        <p>CPF:</p>
        <input type="text" name="cpfUsuario">
        <br>
        <br>
        <p>Telefone:</p>
        <input type="text" name="telefoneUsuario">
        <br>
        <br>
        <p>Email:</p>
        <input type="text" name="emailUsuario">
        <br>
        <br>
        <br>
        <input class="enviar" type="submit">


    </form>
</div>


<?php

    include_once __DIR__ . '/includes/footer.php';

?>