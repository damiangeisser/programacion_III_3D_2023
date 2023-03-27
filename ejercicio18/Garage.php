<?php
/*
Aplicación Nº 18 (Auto - Garage)
Enunciado:Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Remove($autoUno);
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

}

?>
