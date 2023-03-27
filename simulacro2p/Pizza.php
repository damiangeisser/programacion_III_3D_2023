<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

class Pizza {

    public $_id;
    public $_sabor;
    public $_precio;
    public $_tipo;
    public $_cantidad;

    public function __construct($id = 1, $sabor, $precio, $tipo, $cantidad = 0)
    {
        $this->_id = $id;
        $this->_sabor = $sabor;
        $this->_precio = $precio;
        $this->_tipo = $tipo;
        $this->_cantidad = $cantidad;
    }

    // public function Equals($pizza1, $pizza2)
    // {
    //     $respuesta = false;

    //     if(gettype($pizza1) == "object" && get_class($pizza1) == "Pizza" && gettype($pizza2) == "object" && get_class($pizza2) == "Pizza")
    //     {
    //         $respuesta =  $pizza1->_sabor == $pizza2->_sabor && $pizza1->_tipo == $pizza2->_tipo;
    //     }

    //     return $respuesta;
    // }
}

?>