<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

switch($_SERVER['REQUEST_METHOD'])
{
    case("GET"):

        require_once "./PizzaCarga.php";

        AgregarPizza($_GET["sabor"], $_GET["precio"], $_GET["tipo"], $_GET["cantidad"], "./Pizza.json");

        break;

    case("POST"):

        switch ($_POST["operacion"]) {

            case 'AltaVenta':

                require_once "./AltaVenta.php";

                $respuesta = ValidarStock($_POST["email"], $_POST["sabor"], $_POST["tipo"], $_POST["cantidad"]);

                break;

            case 'PizzaConsultar':

                require_once "./PizzaConsultar.php";

                $respuesta = ValidarStock($_POST["sabor"], $_POST["tipo"]);

                break;
            
            default:
                $respuesta = "No se ha podido procesar la solicitud";
                break;
        }



        break;

    default:
        $respuesta = "Ha ocurrido un error con su solicitud.";
        break; 
}

echo $respuesta;
 
?>