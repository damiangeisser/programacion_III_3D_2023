<?php
/*
Aplicación Nº 18 (Auto - Garage)
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
}

?>