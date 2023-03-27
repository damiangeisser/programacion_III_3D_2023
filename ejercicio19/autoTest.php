<?php
/*
Aplicación Nº 19 (Auto)
Alumno: Geisser, Damian
*/

require_once ".\Auto.php";

$autos = array(new Auto("BMW", "rojo"), 
               new Auto("BMW", "negro"),
               new Auto("Toyota", "azul", 5000.50),
               new Auto("Toyota", "azul", 6500.50),
               new Auto("Ford", "blanco", 4000.50, date("d-M-Y"))
               );

Auto::GuardarAutos($autos, ".\autos.csv");

$autosGuardados = Auto::LeerAutos(".\autos.csv");

foreach($autosGuardados as $autoGuardado)
{
    Auto::MostrarAuto($autoGuardado);
}

for ($i = count($autosGuardados)-1; $i > count($autosGuardados)-4; $i--) {

    $autosGuardados[$i]->AgregarImpuesto(1500.00);   
}

$resultadoSuma = Auto::Add($autosGuardados[0],$autosGuardados[1]);

echo $resultadoSuma . "<br>";

if($autosGuardados[0]->Equals($autosGuardados[0], $autosGuardados[1]) && $autosGuardados[0]->Equals($autosGuardados[0], $autosGuardados[4]))
{
    echo "Los autos son iguales. <br>";
}
else{
    echo "Los autos no son iguales. <br>";
}

for ($i = 0; $i < count($autosGuardados); $i+=2) {

    Auto::MostrarAuto($autosGuardados[$i]);
}

?>