<?php
/*
Aplicación Nº 24 (Listado JSON y array de usuarios)
Alumno: Geisser, Damian
*/

require_once "./Usuario/Usuario.php";

$respuesta = "";

switch($_SERVER['REQUEST_METHOD'])
{
  case("POST"):

    $solicitud = $_POST;

    $archivo = $_FILES;

    $respuesta = Usuario::ValidarSolicitudAltaUsuario($solicitud, $archivo);

    if($respuesta == "")
    {
        $archivoImagen = $_FILES["archivo"]["tmp_name"];

        $destinoImagen = "";

        if(isset($_FILES["archivo"]["name"]) && !empty($_FILES["archivo"]["name"]))
        {
          $destinoImagen = "./Usuario/Fotos/" . $_FILES["archivo"]["name"];
        }

        Usuario::CargarFoto($archivoImagen, $destinoImagen);

        Usuario::AgregarUsuario($solicitud["nombre"], $solicitud["clave"], $solicitud["mail"], $destinoImagen, "./usuarios.json");

        $respuesta = "Usuario cargado correctamente";
    }

    break;

  case("GET"):
      $respuesta = Usuario::GetUsuarios("./usuarios.json");
      break;

  default:
    $respuesta = "Ha ocurrido un error con su solicitud.";
    break; 
}

echo $respuesta;

?>