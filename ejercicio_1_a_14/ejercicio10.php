<?php
/*
Aplicación Nº 10 (Arrays de Arrays)
Enunciado: Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
Alumno: Geisser, Damian
*/

$lapicerasAsociadas = array("lapicera1"=> array("color"=> "verde", "marca"=> "Bic", "trazo"=> "0.75", "precio"=> 10),
                            "lapicera2"=> array("color"=> "negro", "marca"=>  "Stabilo", "trazo"=> "1.25", "precio"=> 6),
                            "lapicera3"=> array("color"=> "azul", "marca"=>  "Pilot", "trazo"=> "1", "precio"=> 8),
                            );

$lapicerasIndexadas[0] = array("color"=> "rojo", "marca"=>  "Rotring", "trazo"=> "0.5", "precio"=> 7);
$lapicerasIndexadas[1] = array("color"=> "azul", "marca"=>  "Pelikan", "trazo"=> "1.5", "precio"=> 5);
$lapicerasIndexadas[2] = array("color"=> "verde", "marca"=>  "Stabilo", "trazo"=> "0.25", "precio"=> 9);

echo "Array asociativo:<br>";

var_dump($lapicerasAsociadas);

echo "<br><br>Array indexado:<br>";

var_dump($lapicerasIndexadas);

?>
