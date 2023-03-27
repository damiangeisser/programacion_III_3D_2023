<?php
/*
Aplicación Nº 12 (Invertir palabra)
Enunciado: Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
Alumno: Geisser, Damian
*/

function InvertirArray($charArray)
{
    $charInvertido = array();

    for ($i = count($charArray)-1; $i > -1; $i--) {
    
        array_push($charInvertido, $charArray[$i]);   

    }
    
    return $charInvertido;
};

$letras = array('H','O','L','A');

$resultado = InvertirArray($letras);

var_dump($resultado);


?>
