<?php
/*
Aplicación Nº 24 (Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>apellido, nombre,foto</li>
<li>apellido, nombre,foto</li>
</ul>
Hacer los métodos necesarios en la clase usuario
Alumno: Geisser, Damian
*/

class Usuario {

    public $_id;
    public $_nombre;
    public $_clave;
    public $_mail;
    public $_fechaDeRegistro;
    public $_foto;

    public function __construct($nombre, $clave, $mail, $fechaDeRegistro = "", $foto ="")
    {
        $this->_id = rand(1, 10000);
        $this->_nombre = $nombre;
        $this->_clave = $clave;
        $this->_mail = $mail;
        $this->_foto = $foto;
        
        if(isset($fechaDeRegistro) && !empty($fechaDeRegistro))
        {
            $this->_fechaDeRegistro = $fechaDeRegistro;
        }else
        {
            $this->_fechaDeRegistro = date("Y-m-d"); 
        }
    }

    //Instancia un Usuario y lo agrega al archivo especificado
    public static function AgregarUsuario($nombre, $clave, $mail, $foto, $archivo)
    {
        $nuevoUsuario = new Usuario($nombre, $clave, $mail, "", $foto);

        $usuariosCargados = Usuario::LeerUsuarios($archivo);

        array_push($usuariosCargados, $nuevoUsuario);

        $archivoUsuarios = fopen($archivo, 'w');

        fputs($archivoUsuarios, Usuario::UsuariosToJson($usuariosCargados));

        fclose($archivoUsuarios);
    }

    //Valida que la solicitud tenga todos los datos necesarios.
    public static function ValidarSolicitudAltaUsuario($solicitud, $archivoImagen)
    {
        $mensajeError = "";

        if (array_key_exists("nombre",$solicitud))
        {
            if(!isset($solicitud["nombre"]) || (empty($solicitud["nombre"])))
            {
                $mensajeError = "El nombre enviado no es válido.";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'nombre' no ha sido enviado.";
        }

        if (array_key_exists("clave",$solicitud))
        {
            if(!isset($solicitud["clave"]) || (empty($solicitud["clave"])))
            {
                $mensajeError = "La clave enviada no es válida.";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'clave' no ha sido enviado.";
        }

        if (array_key_exists("mail",$solicitud))
        {
            if(!isset($solicitud["mail"]) || (empty($solicitud["mail"])))
            {
                $mensajeError = "El mail enviado no es válido.";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'mail' no ha sido enviado.";
        }

        //La foto de perfil no es obligatoria.
        if (array_key_exists("archivo", $archivoImagen))
        {
            if(isset($archivoImagen["archivo"]) && !empty($archivoImagen["archivo"]))
            {
                if (array_key_exists("tmp_name", $archivoImagen["archivo"]) && array_key_exists("name", $archivoImagen["archivo"]))
                {
                    if(isset($archivoImagen["archivo"]["tmp_name"]) && !empty($archivoImagen["archivo"]["tmp_name"]) && isset($archivoImagen["archivo"]["name"]) && !empty($archivoImagen["archivo"]["name"]))
                    {
                        $destinoImagen = "./Usuario/Fotos/" . $archivoImagen["archivo"]["name"];

                        if(is_file($destinoImagen))
                        {
                            $mensajeError = "Ya existe un archivo de imagen con ese nombre.";
                        }
                    }
                }else{
                    $mensajeError = "El archivo enviado no es válido.";  
                }
            }else{
                $mensajeError = "El archivo enviado no es válido.";  
            }
        }
        
        return $mensajeError;
    }

    //castea un Usuario a Json.
    public function ToJson()
    {
        $usuarioJson = json_encode($this);

        return $usuarioJson;
    }

    //castea un array de Usuarios a Json.
    public static function UsuariosToJson($usuarios)
    {
        $usuariosJson = json_encode($usuarios);

        return $usuariosJson;
    }

    //carga una foto en un directorio especificado.
    public static function CargarFoto($archivo, $destino)
    {
        move_uploaded_file($archivo, $destino);      
    }

    //Devuelve una lista de Usuario desde un array de Usuario.
    public static function GetUsuarios($archivo)
    {
        $usuarios = Usuario::LeerUsuarios($archivo);

        $respuesta = "<ul>";

        foreach($usuarios as $usuario)
        {
            $respuesta = $respuesta . "<li>". $usuario->_id . ", " . $usuario->_nombre . ", " . $usuario->_mail . ", " . $usuario->_fechaDeRegistro . ", " . $usuario->_foto . "</li>";
        }

        $respuesta = $respuesta . "</ul>";

        return $respuesta;
    }

    //Devuelve un array de Usuario desde un archivo json
    public static function LeerUsuarios($archivo)
    {
        $usuarios = array();

        if(is_file($archivo))
        {
            $contenido = file_get_contents($archivo);

            $usuarios = json_decode($contenido);   
        }

        return $usuarios;
    }
}

?>