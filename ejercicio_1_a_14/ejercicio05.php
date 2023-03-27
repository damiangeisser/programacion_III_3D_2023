<?php
/*
Aplicación Nº 5 (Números en letras)
Enunciado: Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Alumno: Geisser, Damian
*/

$num = rand(20, 60);

$decena = floor($num / 10);

$unidad = $num % 10;

$textosDecenas = array("Veinte" => 20, "Veinti" => 2, "Treinta" => 3, "Cuarenta" => 4, "Cincuenta" => 5, "Sesenta" => 6);

$textosUnidades = array("uno" => 1, "dos" => 2, "tres" => 3, "cuatro" => 4, "cinco" => 5, "seis" => 6, "siete" => 7, "ocho" => 8, "nueve" => 9);

$respuesta = "";

if ($decena == 2) {
    //La veintena es un caso particular y debe evaluarse por separado.
    if ($unidad != 0) {
        $respuesta = array_search($decena, $textosDecenas) . array_search($unidad, $textosUnidades);
    } else {
        $respuesta = array_search($num, $textosDecenas);
    }
} else {

    if ($unidad != 0) {
        $respuesta = array_search($decena, $textosDecenas) . " y " . array_search($unidad, $textosUnidades);
    } else {
        $respuesta = array_search($decena, $textosDecenas);
    }
}

echo "$num $respuesta";

?>
