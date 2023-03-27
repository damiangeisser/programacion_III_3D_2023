<?php
/*
Aplicación Nº 20 (Auto - Garage)
Enunciado:Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
$miGarage->Remove($autoUno);
Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un
archivo garages.csv.
Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
garage.csv
Se deben cargar los datos en un array de garage.
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
los métodos.
Alumno: Geisser, Damian
*/

require_once ".\Auto.php";

class Garage {

    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

    public function __construct($razonSocial, $precioPorHora = 0.00)
    {
        $this->_razonSocial = $razonSocial;
            
        if(gettype($precioPorHora) == "double")
        {
            $this->_precioPorHora = $precioPorHora;
        }else
        {
            $this->_precioPorHora = 0.00;
        }
        
        $this->_autos = array();
    }

    public function MostrarGarage(){

            echo "Razón social: " . $this->_razonSocial . "<br>";
            echo "Precio por hora: " . $this->_precioPorHora . "<br>";

            if(count($this->_autos) > 0)
            {
                echo "Autos:<br>";
                for ($i = 0; $i < count($this->_autos); $i++) {

                    Auto::MostrarAuto($this->_autos[$i]);
                }
            }

            echo "<br>";
    }

    public function Equals($auto)
    {
        $resultado = false;

        if(gettype($auto) == "object" && get_class($auto) == "Auto")
        {
            if(count($this->_autos) > 0)
            {
                for ($i = 0; $i < count($this->_autos); $i++) {

                    $resultado = $auto->Equals($auto, $this->_autos[$i]);

                    if($resultado){
                        break;
                    }
                }
            }
        }

        return $resultado;
    }

    public function Add($auto)
    {
        if(gettype($auto) == "object" && get_class($auto) == "Auto")
        {
            if(!($this->Equals($auto)))
            {
                array_push($this->_autos, $auto);
            }else{
                echo "El auto ya se encuentra en el garage.<br>";
            }
        }
    }

    public function Remove($auto)
    {
        if(gettype($auto) == "object" && get_class($auto) == "Auto")
        {
            if($this->Equals($auto))
            {
                for ($i = 0; $i < count($this->_autos); $i++) {

                    if($auto->Equals($auto, $this->_autos[$i])){
                        
                        unset($this->_autos[$i]);

                        $this->_autos = array_values($this->_autos);

                        break;
                    }
                }
            }else{
                echo "El auto no se encuentra en el garage.<br>";
            }
        }
    }

    //Instancia un Garage y lo agrega al archivo especificado
    public static function GuardarGarageNuevo($razonSocial, $precioPorHora = 0.00, $archivo)
    {
        $nuevoGarage = new Garage($razonSocial, $precioPorHora);

        $archivoGarages = fopen($archivo, 'w');

        fputs($archivoGarages, $nuevoGarage->ToCSV());

        fclose($archivoGarages);
    }

    //Instancia un Garage con autos y lo agrega al archivo especificado
    public static function GuardarGarage($razonSocial, $precioPorHora = 0.00, $autos = array(), $archivo)
    {
        $nuevoGarage = new Garage($razonSocial, $precioPorHora);

        if(count($autos) > 0)
        {
            $nuevoGarage->_autos = $autos;
        }

        $archivoGarages = fopen($archivo, 'w');

        fputs($archivoGarages, $nuevoGarage->ToCSV());

        fclose($archivoGarages);
    }

    //Agrega un array de Garage al archivo especificado
    public static function GuardarGarages($garages, $archivo)
    {
        $garagesCSV = Garage::ArrayToCSV($garages);

        $archivoGarages = fopen($archivo, 'w');

        foreach ($garagesCSV as $garageCSV) {
            fputs($archivoGarages, $garageCSV);
        }

        fclose($archivoGarages);
    }

    //castea un Garage a CSV
    public function ToCSV()
    {
        if(count($this->_autos) > 0)
        {
            $autosCSV = Auto::ArrayToCSVAnidado($this->_autos);

            $garageCSV = $this->_razonSocial . "," . $this->_precioPorHora . "," .  $autosCSV . PHP_EOL;
        }
        else{

            $garageCSV = $this->_razonSocial . "," . $this->_precioPorHora . PHP_EOL;
        }
    
        return $garageCSV;
    }

    //castea un array de Garage a un array de CSV
    private static function ArrayToCSV($garages)
    {
        $arrayCSV = array();

        foreach ($garages as $garage) {

            $garageCSV = $garage->ToCSV();

            array_push($arrayCSV, $garageCSV);    
        }

        return $arrayCSV;
    }

    //Devuelve un array de autos desde un archivo CSV
    public static function LeerGarages($archivo)
    {
        $garagesString = Garage::ObtenerGarages($archivo);

        $garages = Garage::MapearGarages($garagesString);

        return $garages;
    }

    //Devuelve un array de strings del contenido de un archivo .csv
    private static function ObtenerGarages($archivo)
    {
        $archivoGarages = fopen($archivo, "r");

        $garages = array();

        while(!feof($archivoGarages))
        {
            $garage = fgetcsv($archivoGarages);

            if($garage<>null && !(empty($garage)))
            {
                array_push($garages, implode(",", $garage));
            }    
        }

        fclose($archivoGarages);

        return $garages;
    }

    
    //Mapea un array de strings en un array de Auto
    private static function MapearGarages($arrayGaragesString)
    {
        $garages = array();

        foreach ($arrayGaragesString as $garageString) {

            if($garageString<>null && !(empty($garageString)))
            {
                $atributos = explode(",", $garageString);

                $garage = new Garage($atributos[0], $atributos[1]);
                
                //proceso los autos
                if(count($atributos) == 3 && $atributos[2]<>null && !(empty($atributos[2])))
                {
                    $corchetes = array("[", "]");

                    $autosAnidados = str_replace($corchetes, "", $atributos[2]);

                    $arrayAutosString = explode("|", $autosAnidados);

                    $autos = Auto::MapearAutosAnidados($arrayAutosString);

                    $garage->_autos =  $autos;
                }

                array_push($garages, $garage);
            } 
        }

       return $garages;
    }

}

?>
