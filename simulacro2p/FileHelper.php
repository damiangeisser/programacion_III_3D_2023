<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

class FileHelper
{
    //Devuelve un array de objetos desde un archivo json
    public static function LeerJson($archivo)
    {
        $objetos = array(); 

        if(is_file($archivo))
        {
            $contenido = file_get_contents($archivo);   

            $objetos = json_decode($contenido);   
        }   

        return $objetos;
    }

    //Codifica un array de objetos a Json.
    public static function ObjetosToJson($objetos)
    {
        $objetosJson = json_encode($objetos);

        return $objetosJson;
    }

    //Guarda un json en un archivo determinado.
    public static function GuardarJson($archivo, $json)
    {
        $archivoJson = fopen($archivo, 'w');

        fputs($archivo, $json);
    
        fclose($archivo);
    }
    
}

?>