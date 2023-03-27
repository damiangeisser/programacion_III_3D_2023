<?php
/*
Aplicación Nº 13 (Validar palabra)
Enunciado: Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
1 si la palabra pertenece a algún elemento del listado.
0 en caso contrario.
Alumno: Geisser, Damian
*/

function ValidarPalabra($palabra, $max)
{
    $retorno = 0;

    if(strlen($palabra) <= $max)
    {
        switch ($palabra) {
            case "Recuperatorio":
            case "Parcial":
            case "Programacion":
                $retorno = 1;
                break;           
            default:
                break;
        }
    }

    return $retorno;
};

$resultado = ValidarPalabra("Programacion", 12);

echo $resultado . "<br>";

$resultado = ValidarPalabra("Programacion", 2);

echo $resultado . "<br>";

$resultado = ValidarPalabra("Casa", 4);

echo $resultado . "<br>";

$resultado = ValidarPalabra("Casa", 1);

echo $resultado . "<br>";


?>
