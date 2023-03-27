<?php
/*
Aplicación Nº 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.
Alumno: Geisser, Damian
*/

$fechaActual = date('d/m/y');
$fechaActualCompleta = date('M D d Y');
$mesActual = date(date('m'));
$diaActual = intval(date('d'));
$estacion;

switch ($mesActual) {
    case '01':
    case '02':
        $estacion = 'Verano';
        break;
    case '03':
        if($diaActual < 22)
        {
            $estacion = 'Verano';
        }
        else
        {
            $estacion = 'Otoño';
        }
        break;
    case '04':
    case '05':
        $estacion = 'Otoño';
        break;
    case '06':
        if($diaActual < 22)
        {
            $estacion = 'Otoño';
        }
        else
        {
            $estacion = 'Invierno';
        }
        break;
    case '07':
    case '08':
        $estacion = 'Invierno';
        break;
    case '09':
        if($diaActual < 22)
        {
            $estacion = 'Invierno';
        }
        else
        {
            $estacion = 'Primavera';
        }
        break;
    case '10':
    case '11':
        $estacion = 'Primavera';
        break;
    case '12':
        if($diaActual < 22)
        {
            $estacion = 'Primavera';
        }
        else
        {
            $estacion = 'Verano';
        }
        break;
    default:
        $estacion = 'Error';
        break;
}

echo('La fecha es: ' . $fechaActual . ' ó ' . $fechaActualCompleta . '<br>La estación es: ' . $estacion);
?>