<?php
/*
Aplicación Nº 21 ( Listado CSV y array de usuarios)
Alumno: Geisser, Damian
*/

require_once ".\Usuario.php";

$respuesta = "";

switch($_SERVER['REQUEST_METHOD'])
{
  case("POST"):

    $solicitud = $_POST;

    $respuesta = Usuario::ValidarSolicitudAltaUsuario($solicitud);

    if($respuesta == "")
    {
        Usuario::AgregarUsuario($solicitud["nombre"], $solicitud["clave"], $solicitud["mail"], ".\usuarios.csv");

        $respuesta = "Usuario cargado correctamente";
    }
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