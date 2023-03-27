<?php
/*
Aplicación Nº 19 (Auto)
Enunciado:Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
por parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un
archivo autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.
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

    //castea un array de autos a CSV
    private static function ArrayToCSV($autos)
    {
        $arrayCSV = array();

        foreach ($autos as $auto) {

            $autoCSV = $auto->ToCSV();

            array_push($arrayCSV, $autoCSV);    
        }

        return $arrayCSV;
    }
}

?>