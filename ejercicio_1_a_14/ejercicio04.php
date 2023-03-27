<?php
/*
Aplicación Nº 4 (Calculadora)
Enunciado: Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.
Alumno: Geisser, Damian
*/

$operador = array('+', '-', '/', '*');

$op1 = rand(-10, 10);

$op2 = rand(-10, 10);

$resultado = 0;

$respuesta ="";

foreach ($operador as $operacion) {

    switch ($operacion) {
        case '+':
            $resultado = $op1 + $op2;
            break;
        case '-':
            $resultado = $op1 - $op2;
            break;
        case '/':
            if ($op2 != 0) {
                $resultado = $op1 / $op2;
            } else {
                $resultado = 0;
            }
            break;
        case '*':
            $resultado = $op1 * $op2;
            break;
        default:
            $resultado = 0;
            break;
    }

    if($op2 < 0){
        $respuesta =  "$op1 $operacion ($op2) = $resultado<br>";
    }else{
        $respuesta =  "$op1 $operacion $op2 = $resultado<br>";
    }

    echo "$respuesta";
}

?>