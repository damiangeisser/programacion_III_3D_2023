<?php
/*
Aplicación Nº 16 (Rectangulo - Punto)
Enunciado: Codificar las clases Punto y Rectangulo.
La clase Punto ha de tener dos atributos privados con acceso de sólo lectura (sólo con
getters), que serán las coordenadas del punto. Su constructor recibirá las coordenadas del
punto.
La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3
y _vertice4 (que corresponden a los cuatro vértices del rectángulo).
La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener
un constructor para construir el rectángulo por medio de los vértices 1 y 3.
Los atributos ladoUno, ladoDos, área y perímetro se deberán inicializar una vez construido el
rectángulo.
Desarrollar una aplicación que muestre todos los datos del rectángulo y lo dibuje en la página.
Alumno: Geisser, Damian
*/

class Punto {

    private $_x;
    private $_y;

    public function __construct($x, $y)
    {
        if(gettype($x) == "integer")
        {
            $this->_x = $x;

        }
        else{
            $this->_x = 0;
        }

        if(gettype($y) == "integer")
        {
            $this->_y = $y;

        }
        else{
            $this->_y = 0;
        }    
    }

    public function GetX (){
        return $this->_x;
    }

    public function GetY (){
        return $this->_y;
    }
}

?>