<?php
/*
Aplicación Nº 1 (Sumar números)
Enunciado:Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
Alumno: Geisser, Damian
*/

$total = 0;
$sumando = 1;
$contador = 0;

echo("Números sumados: ");

do {
    $contador++;

    $total = $total + $sumando;

    echo($sumando . " ");

    $sumando++;

} while ($total + $sumando <= 1000);

echo("<br>Cantidad de números sumados: $contador");

?>