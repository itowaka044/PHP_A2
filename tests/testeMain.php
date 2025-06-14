<?php

namespace tests;

require_once 'C:\xampp\htdocs\PHP_A2\controllers\ReservaController.php';
require_once 'C:\xampp\htdocs\PHP_A2\controllers\QuadraController.php';

use controllers\ReservaController;

use controllers\QuadraController;


$quadras = QuadraController::mostrarQuadras();

foreach($quadras as $quadra){
    echo "id: " . $quadra['idQuadra'] . "<br>";
    echo "nome: " . $quadra['nomeQuadra'] . "<br>";
    echo "tipo: " . $quadra['tipo'] . "<br>" ;
    echo "valorHora: " . ($quadra['valorHora']/100) . "<br>";
}

?>

<p>___________________________________________________________________</p>

<?php

$quadra2 = QuadraController::mostrarQuadraPorId()

?>

<p>___________________________________________________________________</p>

<form action="http://localhost/PHP_A2/reserva/marcar" method="post">
    <br>
    <p>nome</p>
    <input type="text" name="clienteNome">
    <br>
    <p>cpf</p>
    <input type="text" name="clienteCpf">
    <br>
    <p>telefone</p>
    <input type="text" name="clienteTelefone">
    <br>
    <p>data</p>
    <input type="date" name="reservaData">
    <br><br>
    <p>tipo de quadra</p>
    <select name="quadraId" id="cars">
        <option value="1">society aberta</option>
        <option value="2">society coberta</option>
        <option value="3">futsal coberta</option>
    </select>
    <br><br>
    <input type="submit">
    <br><br>
</form>

<p>___________________________________________________________________</p>

