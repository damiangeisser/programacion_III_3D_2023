<?php
/*
Simulacro 1er Parcial - 1era parte
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
}

?>