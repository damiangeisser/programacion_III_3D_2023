<?php
/*
Aplicación Nº 20 (Registro CSV)
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

    default:
    $respuesta = "Ha ocurrido un error con su solicitud.";
    break; 
}

echo $respuesta;

?>