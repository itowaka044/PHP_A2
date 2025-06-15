<form method="get">
    <p>data:</p>
    <input type="date" name="date">
    <br>
    <p>quadra id:</p>
    <input type="number" name="id">
    <br>
    <input type="submit">
</form>


<?php


    require_once "C:\\xampp\htdocs\PHP_A2\controllers\HorarioController.php";
    use controllers\HorarioController;

    $horarios = HorarioController::consultarHorarioDisp();
    
    foreach($horarios as $horario){
        echo "idHorario: " . $horario["idHorario"] . "<BR>"
        . "idQuadra: " . $horario["idQuadra"] . "<BR>"
        . "dataHorario: " . $horario["dataHorario"] . "<BR>"
        . "horaInicio: " . $horario["horaInicio"] . "<BR>"
        . "horaFim: " . $horario["horaFim"] . "<BR>"
        . "
        <Br><br>";
    }

?>

<p>____________________________________________________________</p>

<form method="get">
    <p>idHorario</p>
    <input type="number" name="idHorario">
    <br>
    <p>idCliente</p>
    <input type="number" name="idCliente">
    <br>
    <p>quadra id:</p>
    <input type="number" name="idQuadra">
    <br>
    <input type="submit">
    <br>

</form>

<?php

    require_once "C:\\xampp\htdocs\PHP_A2\controllers\ReservaController.php";

    use controllers\ReservaController;

    ReservaController::criarReserva();


?>
