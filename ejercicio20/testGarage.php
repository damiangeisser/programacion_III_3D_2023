<?php
/*
Aplicación Nº 20 (Auto - Garage)
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

Garage::GuardarGarage("Ese rayón ya estaba S.R.L.", 300.00, $autos, ".\garage_con_autos.csv");

Garage::GuardarGarageNuevo("Ese rayón ya estaba S.R.L.", 300.00, ".\garage_sin_autos.csv");

echo "---------- Test de métodos nuevos ----------<br>";

$autos1 = array(new Auto("BMW", "rojo"), 
               new Auto("Volkswagen", "negro"),
               new Auto("Toyota", "azul"),
               new Auto("Nissan", "naranja"),
               new Auto("Ford", "blanco")
               );

$autos2 = array(new Auto("Volvo", "verde"), 
new Auto("Fiat", "blanco"),
new Auto("Ford", "azul", 5000.50),
new Auto("Hyundai", "amarillo", 6500.50),
new Auto("Tata", "gris", 4000.50, date("d-M-Y"))
);

$garages = array();

$garage1 = new Garage("Ese rayón ya estaba S.R.L.", 300.00);

foreach($autos1 as $auto)
{
   $garage1->Add($auto);
}

array_push($garages, $garage1);

$garage2 = new Garage("Nunca tenemos lugar S.A.", 50.00);

foreach($autos2 as $auto)
{
   $garage2->Add($auto);
}

array_push($garages, $garage2);

$garage3 = new Garage("El seguro te lo debo S.A.C.I.F.I.");

array_push($garages, $garage3);

Garage::GuardarGarages($garages, ".\garages.csv");

$garages = Garage::LeerGarages(".\garages.csv");

foreach($garages as $garage)
{
   $garage->MostrarGarage();
}

?>