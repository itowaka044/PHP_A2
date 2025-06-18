<?php

include_once __DIR__ . '/includes/header.php';

?>
<div id="selecionar">

    <form action="/PHP_A2/horario/processar-horario" method="post">

        <?php
            require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
            use security\CsrfToken;
            echo CsrfToken::hiddenHtml();

            
        ?>



        <p>Selecione a quadra:</p>
        <select name="id" id="">
            <option value="1">Quadra A</option>
            <option value="2">Quadra B</option>
            <option value="3">Quadra C</option>
        </select>
        <br>

        <p>Selecione o dia:</p>
        <input type="date" name="date">
        <br><br>
        <input class="enviar" type="submit">

    </form>
</div>
<?php
?>



