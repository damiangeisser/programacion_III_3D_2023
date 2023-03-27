<?php
/*
Aplicación Nº 15 (Figuras geométricas)
Alumno: Geisser, Damian
*/

require_once ".\FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica{

    private $_ladoUno; //base
    private $_ladoDos; //altura
    
    public function __construct($l1, $l2)
    {
        if(gettype($l1) == "double")
        {
            $this->_ladoUno = $l1;
        }else{
            $this->_ladoUno = 0.000;
        }

        if(gettype($l2) == "double")
        {
            $this->_ladoDos = $l2;
        }else{
            $this->_ladoDos = 0.000;
        }

        $this->CalcularDatos();
    }

    protected function CalcularDatos()
    {
        $this->_perimetro = ($this->_ladoUno + $this->_ladoDos) * 2;

        $this->_superficie = $this->_ladoUno * $this->_ladoDos;
    }

    public function ToString()
    {
        return "Base: " . $this->_ladoUno . "<br> Altura: " . $this->_ladoDos . "<br>" . parent::ToString() . "<br>";
    }

    public function Dibujar()
    {
        $color = $this->GetColor();

        $figura = "";
        
        for($i=0; $i < $this->_ladoDos; $i++) { 

            for($j=0; $j < $this->_ladoUno; $j++) { 
              $figura = $figura . "*";
            }

            $figura = $figura . "<br>";
        }

        echo $color . "<br>" . $figura;
    }
}

$rectanguloTest = new Rectangulo(4.00,6.00);

$rectanguloTest->SetColor("rojo");

echo $rectanguloTest->ToString();

$rectanguloTest->Dibujar();

?>