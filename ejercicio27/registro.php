<?php
/*
Aplicación Nº 27 (Registro BD)
Alumno: Geisser, Damian
*/

require_once ".\Usuario.php";

$respuesta = "";

switch($_SERVER['REQUEST_METHOD'])
{
  case("POST"):

    $solicitud = $_POST;

    $respuesta = Usuario::ValidarSolicitudUsuario($solicitud);

    if($respuesta == "")
    {
        $idUsuario = Usuario::InsertarUsuario($solicitud["nombre"], $solicitud["apellido"], $solicitud["localidad"], $solicitud["mail"], $solicitud["clave"]);

        $respuesta = "Usuario ID:" . $idUsuario . " cargado correctamente";
    }
    break;

    default:
    $respuesta = "Ha ocurrido un error con su solicitud.";
    break; 
}

echo $respuesta;

?>