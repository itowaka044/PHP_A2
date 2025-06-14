<?php


namespace Horario;

use models\Quadra;
use models\Reserva;

class Horario{

    public int $idHorario;
    public int $idQuadra;
    public string $dataHorario;
    public string $horaInicio;
    public string $horaFim;
    public bool $statusDisp;

}

?>