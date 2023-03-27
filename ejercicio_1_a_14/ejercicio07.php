<?php
/*
Aplicación Nº 7 (Mostrar impares)
Enunciado: Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta. Repetir la impresión de
los números utilizando las estructuras while y foreach.
Alumno: Geisser, Damian
*/

$impares = array();
$impar = 1;
$index = 0;

while(count($impares) < 10){

    array_push($impares, ($impar));
    
    $impar += 2;
}

echo "Utilizando el for: <br>";

for ($i = 0; $i < count($impares); $i++) {
    
    echo $impares[$i] . "<br>";
}

echo "<br> Utilizando el while: <br>";

while($index < count($impares)){

    echo $impares[$index] . "<br>";

    $index++;
}

echo "<br> Utilizando el foreach: <br>";

foreach($impares as $valor)
{
    echo "$valor <br>";
}

?>