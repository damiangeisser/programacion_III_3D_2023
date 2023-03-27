<?php
/*
Aplicación Nº 18 (Auto - Garage)
Alumno: Geisser, Damian
*/

require_once ".\Garage.php";

$autos = array(new Auto("BMW", "rojo"), 
               new Auto("Volkswagen", "negro"),
               new Auto("Toyota", "azul"),
               new Auto("Nissan", "azul"),
               new Auto("Ford", "blanco")
               );

$garage = new Garage("Ese rayón ya estaba S.R.L.", 300.00);

for ($i = 0; $i < count($autos); $i++) {
   $garage->Add($autos[$i]);
}

$garage->MostrarGarage();

$garage->Add($autos[0]);

$garage->Add(new Auto("Peugeot", "marrón"));

$garage->MostrarGarage();

$garage->Remove(new Auto("Fiat", "amarillo"));

$garage->Remove($autos[0]);

$garage->MostrarGarage();

?>