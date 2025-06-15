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
        echo "idHorario: " . $horario["idHorario"] . "<BR>";
        echo "dataHorario: " . $horario["dataHorario"] . "<BR>";
        echo "horaInicio: " . $horario["horaInicio"] . "<BR>";
        echo "horaFim: " . $horario["horaFim"] . "<BR>";
        echo "<Br><br>";
    }

?>
