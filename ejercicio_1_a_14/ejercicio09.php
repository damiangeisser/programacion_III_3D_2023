<?php
/*
Aplicación Nº 9 (Arrays asociativos)
Enunciado: Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
Alumno: Geisser, Damian
*/

$colores = array("azul","negro","rojo","verde");

$marcas = array("Bic","Pilot","Rotring","Stabilo","Pelikan");

$trazos = array("0.5","0.75","1","1.25","1.5");

$lapiceras = array();

for ($i = 0; $i < 3; $i++) {
    
    $lapicera = array("color" => $colores[rand(0,3)], "marca" => $marcas[rand(0,4)], "trazo" =>  $trazos[rand(0,4)], "precio" => rand(3,10));

    array_push($lapiceras, $lapicera);
}

foreach($lapiceras as $valor){
    var_dump($valor);
    echo "<br>";
}

?>
