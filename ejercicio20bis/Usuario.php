<?php
/*
Aplicación Nº 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
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
        $archivoUsuarios = fopen($archivo, "r");

        $usuarios = array();

        while(!feof($archivoUsuarios))
        {
            $usario = fgetcsv($archivoUsuarios);

            if($usario<>null && !(empty($usario)))
            {
                array_push($usario, implode(",", $usario));
            }    
        }

        fclose($archivoUsuarios);

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

    //Instancia un Usuario y lo agrega al archivo especificado
    public static function ValidarSolicitudAltaUsuario($solicitud)
    {
        $mensajeError = "";

        if (array_key_exists("nombre",$solicitud))
        {
            if($solicitud["nombre"]== null || (empty($solicitud["nombre"])))
            {
                $mensajeError = "El nombre enviado no es válido";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'nombre' no ha sido enviado";
        }

        if (array_key_exists("clave",$solicitud))
        {
            if($solicitud["clave"]== null || (empty($solicitud["clave"])))
            {
                $mensajeError = "La clave enviada no es válida";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'clave' no ha sido enviado";
        }

        if (array_key_exists("mail",$solicitud))
        {
            if($solicitud["mail"]== null || (empty($solicitud["mail"])))
            {
                $mensajeError = "El mail enviado no es válido";  
            }
        }
        else{
            $mensajeError = "El campo requerido 'mail' no ha sido enviado";
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
}

?>