<?php
/*
Aplicación Nº 20 (Registro CSV)
Alumno: Geisser, Damian
*/

require_once "./Usuario/Usuario.php";

$respuesta = "";

switch($_SERVER['REQUEST_METHOD'])
{
  case("POST"):

    $solicitud = $_POST;

    $respuesta = Usuario::ValidarSolicitudUsuario($solicitud);

    if($respuesta == "")
    {
        Usuario::AgregarUsuario($solicitud["nombre"], $solicitud["clave"], $solicitud["mail"], ".\usuarios.json");

        $respuesta = "Usuario cargado correctamente";
    }

    $archivo = $_FILES["archivo"]["tmp_name"];

    $destino = "./Usuario/Fotos/" . $_FILES["archivo"]["name"];

    Usuario::CargarFoto($archivo, $destino);

    break;

    default:
    $respuesta = "Ha ocurrido un error con su solicitud.";
    break; 
}

echo $respuesta;

?>