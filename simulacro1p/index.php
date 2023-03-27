<?php
/*
Simulacro 1er Parcial - 1era parte
Alumno: Geisser, Damian
*/

switch($_SERVER['REQUEST_METHOD'])
{
    case("GET"):

        require_once "./PizzaCarga.php";

        AgregarPizza($_GET["sabor"], $_GET["precio"], $_GET["tipo"], $_GET["cantidad"], "./Pizza.json");

        break;

    case("POST"):

        require_once "./PizzaConsultar.php";

        $respuesta = ValidarStock($_POST["sabor"], $_POST["tipo"]);

        echo $respuesta;

        break;

    default:
        $respuesta = "Ha ocurrido un error con su solicitud.";
        break; 
}
 
?>