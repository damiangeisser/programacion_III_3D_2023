<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

class Venta {

    public $_fecha;
    public $_numeroDePedido;
    public $_imagen;

    public function __construct($fecha, $numeroDePedido, $imagen)
    {
        if(isset($fecha) && !empty($fecha))
        {
            $this->_fecha = $fecha;
        }else
        {
            $this->_fecha = date("Y-m-d"); 
        }
        
        $this->_numeroDePedido = $numeroDePedido;
        $this->_imagen = $imagen;
    }
}

?>