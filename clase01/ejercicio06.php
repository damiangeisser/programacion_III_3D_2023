<?php
/*
Aplicación Nº 6 (Carga aleatoria)
Enunciado: Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.
Alumno: Geisser, Damian
*/

$entero = 0;

$enteros = array_fill(0, 5, 0);

$total = 0;

$promedio = 0;

$respuesta = "";

for ($i = 0; $i < count($enteros); $i++) {
    $entero = rand(-100, 100);

    $enteros[$i] = $entero;

    $total = $total + $entero;
}

$promedio = $total / count($enteros);

if ($promedio > 6) {
    $respuesta = "El promedio $promedio de los cinco números es mayor a 6";
} elseif ($promedio < 6) {
    $respuesta = "El promedio $promedio de los cinco números es menor a 6";
} else {
    $respuesta = "El promedio $promedio de los cinco números es igual a 6";
}

echo "$respuesta";

?>
