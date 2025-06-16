<?php


    


?>

<h1>Resetar senha</h1>
<form action="/PHP_A2/usuario/reset-senha" method="post">

    <?php
        require_once "C:\\xampp\htdocs\PHP_A2\csrf\CsrfToken.php";
        use csrf\CsrfToken;
        echo CsrfToken::hiddenHtml();
    ?>

    <p>Inisira o Usuario:</p>
    <input type="text" name="usuarioRecup">
    <br>

    <p>Insira o CPF:</p>
    <input type="text" name="cpfRecup">
    <br>

    <p>Insira o Email:</p>
    <input name="emailRecup" type="text">
    <br>

    <p>Insira a nova Senha:</p>
    <input type="text" name="novaSenha">
    <br>
    <br>

    <input type="submit">

</form>
