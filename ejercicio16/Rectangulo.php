<?php
/*
Aplicación Nº 16 (Rectangulo - Punto)
*/

use Rectangulo as GlobalRectangulo;

require_once ".\Punto.php";

class Rectangulo {

    private $_vertice1;
    private $_vertice2;
    private $_vertice3;
    private $_vertice4;
    public $_area;
    public $_ladoUno;
    public $_ladoDos;
    public $_perimetro;

    public function __construct($v1, $v3)
    {
        if(gettype($v1) == "object" && get_class($v1) == "Punto" && gettype($v3) == "object" && get_class($v3) == "Punto")
        {
            $this->_vertice1 = $v1;
            $this->_vertice2 = new Punto($v3->GetX(),$v1->GetY());
            $this->_vertice3 = $v3;
            $this->_vertice4 = new Punto($v1->GetX(),$v3->GetY());
        }
        else{
            $this->_vertice1 = new Punto(0,0);
            $this->_vertice2 = new Punto(1,0);
            $this->_vertice3 = new Punto(1,1);
            $this->_vertice4 = new Punto(0,1);
        }

        $this->_ladoUno = $this->_vertice2->GetX() - $this->_vertice1->GetX();

        $this->_ladoDos = $this->_vertice4->GetY() - $this->_vertice1->GetY();

        $this->_perimetro = ($this->_ladoUno + $this->_ladoDos) * 2;

        $this->_area = $this->_ladoUno * $this->_ladoDos;
    }

    public function Dibujar (){

        $figura = "";
        
        for($i=0; $i < $this->_ladoDos; $i++) { 

            if($i == 0 || $i == $this->_ladoDos - 1)
            {
                for($j=0; $j < $this->_ladoUno; $j++) { 
                  $figura = $figura . "*";
                }
            }else{
                $figura = $figura . "*";

                for($j=0; $j < $this->_ladoUno -2 ; $j++) { 
                    $figura = $figura . "&ensp;";
                }

                $figura = $figura . "*";
            }

            $figura = $figura . "<br>";
        }

        $rectangulo = "Vértice 1: (" . $this->_vertice1->GetX() . ";" . $this->_vertice1->GetY() . ")<br>" .
                      "Vértice 2: (" . $this->_vertice2->GetX() . ";" . $this->_vertice2->GetY() . ")<br>" .
                      "Vértice 3: (" . $this->_vertice3->GetX() . ";" . $this->_vertice3->GetY() . ")<br>" .
                      "Vértice 4: (" . $this->_vertice4->GetX() . ";" . $this->_vertice4->GetY() . ")<br>" .
                      "Base: " . $this->_ladoUno . "<br>" .
                      "Altura: " . $this->_ladoDos . "<br>" .
                      "Perímetro: " . $this->_perimetro . "<br>" .
                      "Area: " . $this->_area . "<br>" . $figura;

        echo $rectangulo;
    }
}

$vertice1Test = new Punto(1,1);

$vertice3Test = new Punto(8,6);

$rectanguloTest = new Rectangulo($vertice1Test, $vertice3Test);

$rectanguloTest->Dibujar();

?>