
<form action="/PHP_A2/reserva/processar-reserva" method="post">

    <p>Selecione o ID do horário:</p>
    <input type="number" name="idHorario">

    <p>Selecione o ID da quadra:</p>
    <input type="number" name="idQuadra">

    <br><br>

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
        . "<Br><br>";
    }

?>