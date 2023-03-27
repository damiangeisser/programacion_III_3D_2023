<?php
/*
Aplicación Nº 8 (Carga aleatoria)
Enunciado: Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';
Alumno: Geisser, Damian
*/

$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';

foreach($v as $valor)
{
    echo "$valor ";
}

?>
