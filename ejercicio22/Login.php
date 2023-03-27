<?php
/*
Aplicación Nº 22 (Login)
Alumno: Geisser, Damian
*/

require_once ".\Usuario.php";

$respuesta = "";

switch($_SERVER['REQUEST_METHOD'])
{
  case("POST"):

    $solicitud = $_POST;

    ////Dejo comentado el código del alta por si se necesita crear usuarios.
    // $respuesta = Usuario::ValidarAltaUsuario($solicitud, ".\usuarios.csv");

    // if($respuesta == "")
    // {
    //     Usuario::AgregarUsuario($solicitud["nombre"], $solicitud["clave"], $solicitud["mail"], ".\usuarios.csv");

    //     $respuesta = "Usuario cargado correctamente.";
    // }

    $respuesta = Usuario::ValidarCredencialesUsuario($solicitud, ".\usuarios.csv");

    break;

    case("GET"):
      $respuesta = Usuario::GetUsuarios(".\usuarios.csv");
      break;

    default:
      $respuesta = "Ha ocurrido un error con su solicitud.";
      break; 
}

echo $respuesta;

?>