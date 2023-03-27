<?php
/*
Aplicación Nº 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Alumno: Geisser, Damian
*/

require_once ".\PDOHelper.php";

class Usuario {

    private $_nombre;
    private $_apellido;
    private $_localidad;
    private $_mail;
    private $_clave;
    private $_fechaDeRegistro;
    
    public function __construct($nombre, $apellido, $localidad, $mail, $clave, $fechaDeRegistro = null)
    {
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_localidad = $localidad;
        $this->_mail = $mail;
        $this->_clave = $clave;
        
        if($fechaDeRegistro <> null)
        {
            $this->_fechaDeRegistro = $fechaDeRegistro;
        }else
        {
            $this->_fechaDeRegistro = date("Y-m-d"); 
        }  
    }

    //Valida que la solicituyd tenga todos los datos necesarios.
    public static function ValidarSolicitudUsuario($solicitud)
    {
        $mensajeError = "";

        if (array_key_exists("nombre",$solicitud))
        {
            if($solicitud["nombre"]== null || (empty($solicitud["nombre"])))
            {
                $mensajeError = "El nombre enviado no es válido.";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'nombre' no ha sido enviado.";
        }

        if (array_key_exists("clave",$solicitud))
        {
            if($solicitud["clave"]== null || (empty($solicitud["clave"])))
            {
                $mensajeError = "La clave enviada no es válida.";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'clave' no ha sido enviado.";
        }

        if (array_key_exists("mail",$solicitud))
        {
            if($solicitud["mail"]== null || (empty($solicitud["mail"])))
            {
                $mensajeError = "El mail enviado no es válido.";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'mail' no ha sido enviado.";
        }

        if (array_key_exists("localidad",$solicitud))
        {
            if($solicitud["localidad"]== null || (empty($solicitud["localidad"])))
            {
                $mensajeError = "La localidad enviada no es válida.";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'localidad' no ha sido enviado.";
        }
        
        return $mensajeError;
    }

    public static function InsertarUsuario($nombre, $apellido, $localidad, $mail, $clave)
    {
        $objetoPDOHelper = PDOHelper::ObtenerObjetoPDOHelper(); 
        $consulta =$objetoPDOHelper->PrepararConsulta("INSERT into usuarios (nombre,apellido,localidad,mail,clave,fecha_de_registro)
                                                       values(:nombre,:apellido,:localidad,:mail,:clave,:fecha_de_registro)");
        
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_INT);
        $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $localidad, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $mail, PDO::PARAM_STR);
        $consulta->bindValue(':clave',  $clave, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_registro', date("Y-m-d"), PDO::PARAM_STR);

        $consulta->execute();	

        return $objetoPDOHelper->RetornarUltimoIdInsertado();
    }
}

?>