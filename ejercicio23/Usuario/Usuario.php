<?php
/*
Aplicación Nº 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato
con la fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer
el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.
Alumno: Geisser, Damian
*/

class Usuario {

    public $_id;
    public $_nombre;
    public $_clave;
    public $_mail;
    public $_fechaDeRegistro;

    public function __construct($nombre, $clave, $mail, $fechaDeRegistro = "")
    {
        $this->_id = rand(1, 10000);
        $this->_nombre = $nombre;
        $this->_clave = $clave;
        $this->_mail = $mail; 
        
        if(isset($fechaDeRegistro) && !empty($fechaDeRegistro))
        {
            $this->_fechaDeRegistro = $fechaDeRegistro;
        }else
        {
            $this->_fechaDeRegistro = date("Y-m-d"); 
        }  
    }

    //Instancia un Usuario y lo agrega al archivo especificado
    public static function AgregarUsuario($nombre, $clave, $mail, $archivo)
    {
        $nuevoUsuario = new Usuario($nombre, $clave, $mail);

        $archivoUsuarios = fopen($archivo, 'a');

        fputs($archivoUsuarios, $nuevoUsuario->ToJson() . PHP_EOL);

        fclose($archivoUsuarios);
    }

    //Valida que la solicitud tenga todos los datos necesarios.
    public static function ValidarSolicitudUsuario($solicitud)
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
        
        return $mensajeError;
    }

    //castea un Usuario a Json.
    public function ToJson()
    {
        $usuarioJson = json_encode($this);

        return $usuarioJson;
    }

    //carga una foto en un directorio especificado.
    public static function CargarFoto($archivo, $destino)
    {
        if(!is_file($destino))
        {
            move_uploaded_file($archivo, $destino);
        }
    }
}

?>