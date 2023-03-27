<?php
/*
Aplicación Nº 22 (Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario
Alumno: Geisser, Damian
*/

class Usuario {

    private $_nombre;
    private $_clave;
    private $_mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->_nombre = $nombre;
        $this->_clave = $clave;
        $this->_mail = $mail;        
    }

    public static function MostrarUsuario($usuario){

        if(gettype($usuario) == "object" && get_class($usuario) == "Usuario")
        {
            echo "Nombre: " . $usuario->_nombre . "<br>";
            echo "Clave: " . $usuario->_clave . "<br>";
            echo "Mail: " . $usuario->_mail . "<br>";
            echo "<br>";
        }
    }

    //Devuelve un array de strings del contenido de un archivo .csv
    private static function ObtenerUsuarios($archivo)
    {
        $usuarios = array();

        if (file_exists($archivo)) {

            $archivoUsuarios = fopen($archivo, "r");
    
            while(!feof($archivoUsuarios))
            {
                $usuario = fgetcsv($archivoUsuarios);
    
                if($usuario<>null && !(empty($usuario)))
                {
                    array_push($usuarios, implode(",", $usuario));
                }    
            }
    
            fclose($archivoUsuarios);
        }

        return $usuarios;
    }

    //Mapea un array de strings en un array de Usuario
    private static function MapearUsuarios($arrayUsuariosString)
    {
        $usuarios = array();

        foreach ($arrayUsuariosString as $usuarioString) {

            if($usuarioString<>null && !(empty($usuarioString)))
            {
                $atributos = explode(",", $usuarioString);

                $usuario = new Usuario($atributos[0], $atributos[1], $atributos[2]); 

                array_push($usuarios, $usuario);
            } 
        }

       return $usuarios;
    }

    //Devuelve un array de Usuario desde un archivo CSV
    public static function LeerUsuarios($archivo)
    {
        $usuarioString = Usuario::ObtenerUsuarios($archivo);

        $usuarios = Usuario::MapearUsuarios($usuarioString);

        return $usuarios;
    }

    //Instancia un Usuario y lo guarda en el archivo especificado
    public static function GuardarUsuario($nombre, $clave, $mail, $archivo)
    {
        $nuevoUsuario = new Usuario($nombre, $clave, $mail);

        $archivoUsuarios = fopen($archivo, 'w');

        fputs($archivoUsuarios, $nuevoUsuario->ToCSV());

        fclose($archivoUsuarios);
    }

    //Agrega un array de Usuario al archivo especificado
    public static function GuardarUsuarios($usuarios, $archivo)
    {
        $usuariosCSV = Usuario::ArrayToCSV($usuarios);

        $archivoUsuarios = fopen($archivo, 'w');

        foreach ($usuariosCSV as $usuarioCSV) {
            fputs($archivoUsuarios, $usuarioCSV);
        }

        fclose($archivoUsuarios);
    }

    //Instancia un Usuario y lo agrega al archivo especificado
    public static function AgregarUsuario($nombre, $clave, $mail, $archivo)
    {
        $nuevoUsuario = new Usuario($nombre, $clave, $mail);

        $archivoUsuarios = fopen($archivo, 'a');

        fputs($archivoUsuarios, $nuevoUsuario->ToCSV());

        fclose($archivoUsuarios);
    }

    //Valida que la solicituyd tenga todos los datos necesarios.
    private static function ValidarSolicitudUsuario($solicitud)
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
        
        return $mensajeError;
    }

    //Valida si un usuario ya existe en el registro.
    public static function ValidarAltaUsuario($solicitud, $archivo)
    {
        $mensajeError = Usuario::ValidarSolicitudUsuario($solicitud);

     
        if($mensajeError == "")
        {

            $usuariosExistentes = Usuario::LeerUsuarios($archivo);       

            if(count($usuariosExistentes) > 0)
            {  
                $usuarioEncontrado = Usuario::BuscarUsuario($usuariosExistentes, $solicitud["mail"]);

                if($usuarioEncontrado->_mail <> null && !empty($usuarioEncontrado->_mail))
                {
                    $mensajeError = "Usuario ya existente.";            
                }
            }
        }

        return $mensajeError;
    }

    //Instancia un Usuario y lo agrega al archivo especificado
    public static function ValidarCredencialesUsuario($solicitud, $archivo)
    {
        $mensajeError = Usuario::ValidarSolicitudUsuario($solicitud);

        //Si tengo todos los datos, puedo verificar la existencia del usuario.
        if($mensajeError == ""){
        
            $usuariosExistentes = Usuario::LeerUsuarios($archivo);           

            if(count($usuariosExistentes) > 0)
            {
                $usuarioVerificacion = Usuario::BuscarUsuario($usuariosExistentes, $solicitud["mail"]);

                if($usuarioVerificacion->_mail == "")
                {
                    $mensajeError = "Usuario no registrado.";
                }
                elseif($usuarioVerificacion->_clave <> $solicitud["clave"])
                {
                    $mensajeError = "Error en los datos.";
                }
                else
                {
                    $mensajeError = "Verificado.";
                }
            }
            else
            {
                $mensajeError = "No hay usuarios registrados.";
            }   
        }
        
        return $mensajeError;
    }

    //castea un Usuario a CSV
    public function ToCSV()
    {
        $usuarioCSV = $this->_nombre . "," . $this->_clave . "," . $this->_mail . PHP_EOL;

        return $usuarioCSV;
    }

    //castea un array de Usuario a un array de CSV
    private static function ArrayToCSV($usuarios)
    {
        $arrayCSV = array();

        foreach ($usuarios as $usuario) {

            $usuarioCSV = $usuario->ToCSV();

            array_push($arrayCSV, $usuarioCSV);    
        }

        return $arrayCSV;
    }

    //Devuelve un array de Usuario desde un archivo CSV
    public static function GetUsuarios($archivo)
    {
        $usuarios = Usuario::LeerUsuarios($archivo);

        $respuesta = "<ul>";

        foreach($usuarios as $usuario)
        {
            $respuesta = $respuesta . "<li>" . $usuario->_nombre . ", " . $usuario->_mail . "</li>";
        }

        $respuesta = $respuesta . "</ul>";

        return $respuesta;
    }

    //Retorna un usuario de un array de usuarios.
    private static function BuscarUsuario($usuarios, $mail)
    {
        $usuarioEncontrado = New Usuario("","","");

        if(count($usuarios) > 0){
            foreach($usuarios as $usuario)
            {
                if($usuario->_mail == $mail){
                    $usuarioEncontrado = $usuario;
                    break;
                }
            }
        }

        return $usuarioEncontrado;
    }
}

?>