<?php
/*
Aplicación Nº 17 (Auto)
Enunciado: Realizar una clase llamada “Auto” que posea los siguientes atributos privados:

_color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
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

        if(get_class($auto) == "Auto")
        {
            echo $auto->_marca . "<br>";
            echo $auto->_color . "<br>";
            echo $auto->_precio . "<br>";
            echo $auto->_fecha . "<br>";
        }

    }

    public function Equals($auto1, $auto2)
    {
        if(gettype($auto1) == "object" && get_class($auto1) == "Auto" && gettype($auto2) == "object" && get_class($auto2) == "Auto")
        {
            return $auto1->_marca == $auto2->_marca;
        }
        else{
            return false;
        }
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