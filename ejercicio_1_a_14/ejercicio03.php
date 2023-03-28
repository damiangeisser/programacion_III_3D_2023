<?php
/*
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. Ejemplo 1: $a
= 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”

Alumno: Geisser, Damian
*/

// $a = 6;
// $b = 9;
// $c = 8;

// $a = 5;
// $b = 1;
// $c = 5;

$a = rand(5, 15);
$b = rand(5, 15);
$c = rand(5, 15);

$enunciado = 'Dados los números: ' . $a . '; ' . $b . '; ' . $c;
$resultado;

if($a == $b || $b == $c || $a == $c)
{
    $resultado = 'No hay valor del medio.';
}
elseif ($a > $b) {

    if($a < $c)
    {
        $resultado = $a . ' es el valor medio.';
    }
    elseif ($c > $b) {
        $resultado = $c . ' es el valor medio.';
    }else {
        $resultado = $b . ' es el valor medio.';
    }   
}
elseif ($b < $c) {
    $resultado = $b . ' es el valor medio.';
}
elseif ($c < $a) {
    $resultado = $a . ' es el valor medio.';
}else {
    $resultado = $c . ' es el valor medio.';
}

echo($enunciado . '<br>' . $resultado);

?>