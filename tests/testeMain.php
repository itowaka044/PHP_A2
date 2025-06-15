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

$quadra2 = QuadraController::mostrarQuadraPorId();

echo "id: " . $quadra2['idQuadra'] . "<br>";
echo "nome: " . $quadra2['nomeQuadra'] . "<br>";
echo "tipo: " . $quadra2['tipo'] . "<br>" ;
echo "valorHora: " . ($quadra2['valorHora']/100) . "<br>";

?>

<p>___________________________________________________________________</p>



<p>___________________________________________________________________</p>

