<?php
/*
Aplicación Nº 17 (Auto)
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)
Alumno: Geisser, Damian
*/

require_once ".\Auto.php";

$autos = array(new Auto("BMW", "rojo"), 
               new Auto("BMW", "negro"),
               new Auto("Toyota", "azul", 5000.00),
               new Auto("Toyota", "azul", 6500.00),
               new Auto("Ford", "blanco", 4000.00, date("d-M-Y"))
               );

for ($i = count($autos)-1; $i > count($autos)-4; $i--) {

    $autos[$i]->AgregarImpuesto(1500.00);   
}

$resultadoSuma = Auto::Add($autos[0],$autos[1]);

echo $resultadoSuma . "<br>";

if($autos[0]->Equals($autos[0], $autos[1]) && $autos[0]->Equals($autos[0], $autos[4]))
{
    echo "Los autos son iguales. <br>";
}
else{
    echo "Los autos no son iguales. <br>";
}

for ($i = 0; $i < count($autos); $i+=2) {

    Auto::MostrarAuto($autos[$i]);
}

?>