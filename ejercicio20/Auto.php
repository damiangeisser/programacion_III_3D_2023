<?php
/*
Aplicación Nº 20 (Auto - Garage)
Alumno: Geisser, Damian
*/

class Auto {

    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca, $color, $precio = 0, $fecha = null)
    {
        $this->_marca = $marca;
        $this->_color = $color;
        $this->_precio = $precio;
        
        if($fecha <> null)
        {
            $this->_fecha = $fecha;
        }else
        {
            $this->_fecha = date("d-M-Y"); 
        }     
    }

    public function AgregarImpuesto($monto)
    {
        if($monto <> null && gettype($monto) == "double")
        {
            $this->_precio += $monto;
        }
    }

    public static function MostrarAuto($auto){

        if(gettype($auto) == "object" && get_class($auto) == "Auto")
        {
            echo "Marca: " . $auto->_marca . "<br>";
            echo "Color: " . $auto->_color . "<br>";
            echo "Precio: " . $auto->_precio . "<br>";
            echo "Fecha: " . $auto->_fecha . "<br>";
            echo "<br>";
        }

    }

    public function Equals($auto1, $auto2)
    {
        $resultado = false;

        if(gettype($auto1) == "object" && get_class($auto1) == "Auto" && gettype($auto2) == "object" && get_class($auto2) == "Auto")
        {
            $resultado =  $auto1->_marca == $auto2->_marca;
        }

        return $resultado;
    }

    public static function Add($auto1, $auto2)
    {
        $mensaje ="";
        $resultado = 0;

        if(gettype($auto1) == "object" && get_class($auto1) == "Auto" && gettype($auto2) == "object" && get_class($auto2) == "Auto")
        {
            if($auto1->Equals($auto1, $auto2))
            {
                if($auto1->_color == $auto2->_color)
                {
                    $resultado = $auto1->_precio + $auto2->_precio;
                }
                else{
                    $mensaje = "Los autos no son del mismo color.<br>";
                }
            }
            else{
                $mensaje = "Los autos no son de la misma marca.<br>";
            }
        }

        if(strlen($mensaje) > 1)
        {
            echo $mensaje;
        }

        return $resultado;
    }

    //Devuelve un array de strings del contenido de un archivo .csv
    private static function ObtenerAutos($archivo)
    {
        $archivoAutos = fopen($archivo, "r");

        $autos = array();

        while(!feof($archivoAutos))
        {
            $auto = fgetcsv($archivoAutos);

            if($auto<>null && !(empty($auto)))
            {
                array_push($autos, implode(",", $auto));
            }    
        }

        fclose($archivoAutos);

        return $autos;
    }

    //Mapea un array de strings en un array de Auto
    private static function MapearAutos($arrayAutosString)
    {
        $autos = array();

        foreach ($arrayAutosString as $autoString) {

            if($autoString<>null && !(empty($autoString)))
            {
                $atributos = explode(",", $autoString);

                $auto = new Auto($atributos[0], $atributos[1], $atributos[2], $atributos[3]); 

                array_push($autos, $auto);
            } 
        }

       return $autos;
    }

    //Devuelve un array de autos desde un archivo CSV
    public static function LeerAutos($archivo)
    {
        $autosString = Auto::ObtenerAutos($archivo);

        $autos = Auto::MapearAutos($autosString);

        return $autos;
    }

    //Instancia un auto y lo agrega al archivo especificado
    public static function GuardarAuto($marca, $color, $precio = 0, $fecha = null, $archivo)
    {
        $nuevoAuto = new Auto($marca, $color, $precio, $fecha);

        $archivoAutos = fopen($archivo, 'w');

        fputs($archivoAutos, $nuevoAuto->ToCSV());

        fclose($archivoAutos);
    }

    //Agrega un array de Autos al archivo especificado
    public static function GuardarAutos($autos, $archivo)
    {
        $autosCSV = Auto::ArrayToCSV($autos);

        $archivoAutos = fopen($archivo, 'w');

        foreach ($autosCSV as $autoCSV) {
            fputs($archivoAutos, $autoCSV);
        }

        fclose($archivoAutos);
    }

    //castea un auto a CSV
    public function ToCSV()
    {
        $autoCSV = $this->_marca . "," . $this->_color . "," . $this->_precio . "," . $this->_fecha . PHP_EOL;

        return $autoCSV;
    }

    //castea un array de autos a un array de CSV
    private static function ArrayToCSV($autos)
    {
        $arrayCSV = array();

        foreach ($autos as $auto) {

            $autoCSV = $auto->ToCSV();

            array_push($arrayCSV, $autoCSV);    
        }

        return $arrayCSV;
    }

    //castea un auto a CSV para anidarlo en otro objeto
    public function ToCSVAnidado()
    {
        $autoCSV = $this->_marca . ";" . $this->_color . ";" . $this->_precio . ";" . $this->_fecha;

        return $autoCSV;
    }

    //castea un array de autos a un string en formato CSV para anidarlo en otro objeto
    public static function ArrayToCSVAnidado($autos)
    {
        $CSVAnidado = "[";

        for ($i = 0; $i < count($autos); $i++) {
            
            $CSVAnidado =  $CSVAnidado . $autos[$i]->ToCSVAnidado();

            if($i <> count($autos) - 1)
            {
                $CSVAnidado =  $CSVAnidado . "|";
            }
        }

        $CSVAnidado = $CSVAnidado . "]";

        return $CSVAnidado;
    }

    //Mapea un array de strings en un array de Auto
    public static function MapearAutosAnidados($arrayAutosString)
    {
        $autos = array();

        foreach ($arrayAutosString as $autoString) {

            if($autoString<>null && !(empty($autoString)))
            {
                $atributos = explode(";", $autoString);

                $auto = new Auto($atributos[0], $atributos[1], $atributos[2], $atributos[3]); 

                array_push($autos, $auto);
            } 
        }

       return $autos;
    }
}

?>