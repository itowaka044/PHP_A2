<?php

include_once __DIR__ . '/includes/header.php';

?>

<div id="horarios">
<h1>Horários</h1>

<form action="/PHP_A2/reserva/processar-reserva" method="post">

    <?php
        require_once "C:\\xampp\htdocs\PHP_A2\security\CsrfToken.php";
        use security\CsrfToken;
        echo CsrfToken::hiddenHtml();
    ?>

    <p>Selecione o ID do Horário:</p>
    <input type="number" name="idHorario">

    <BR>
    <BR>

    <p>Selecione o ID da Quadra:</p>
    <input type="number" name="idQuadra">

    <br><br>

    <input CLASS="enviar" type="submit">

</form>
</div>

<div id="mostrarHorarios">

<?php
    require_once "C:\\xampp\htdocs\PHP_A2\controllers\HorarioController.php";
    use controllers\HorarioController;

    $horarios = HorarioController::consultarHorarioDisp();
    
    foreach($horarios as $horario){
        echo "<div class='horarioDiv'>"
        . "<p class='ok'>ID do Horario: " . $horario["idHorario"] . "</p><BR>"
        . "<p class='ok'>ID da Quadra: " . $horario["idQuadra"] . "</p><BR>"
        . "<p>dataHorario: " . $horario["dataHorario"] . "</p><BR>"
        . "<p>horaInicio: " . $horario["horaInicio"] . "</p><BR>"
        . "<p>horaFim: " . $horario["horaFim"] . "</p><BR>"
        . "</div>"
        . "<Br><br>";

    }

?>

</div>