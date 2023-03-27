<?php
/*
Aplicación Nº 15 (Figuras geométricas)
Alumno: Geisser, Damian
*/

require_once ".\FiguraGeometrica.php";

class Triangulo extends FiguraGeometrica{

    private $_base;
    private $_altura;
    
    public function __construct($b, $h)
    {
        if(gettype($b) == "double")
        {
            $this->_base = $b;
        }else{
            $this->_base = 0.000;
        }

        if(gettype($h) == "double")
        {
            $this->_altura = $h;
        }else{
            $this->_altura = 0.000;
        }

        $this->CalcularDatos();
    }

    protected function CalcularDatos()
    {
        //Pitágoras para calcular los lados + la base, se asume un trinángulo isóceles o equilátero.
        $this->_perimetro = (sqrt(pow($this->_base/2,2) + pow($this->_altura,2)) * 2) + $this->_base;

        $this->_superficie = ($this->_base * $this->_altura) / 2;
    }

    public function ToString()
    {
        return "Base: " . $this->_base . "<br> Altura: " . $this->_altura . "<br>" . parent::ToString() . "<br>";
    }

    public function Dibujar()
    {
        $color = $this->GetColor();

        $figura = "";

        $incrementoPuntos = $this->_base / $this->_altura;

        $espaciado = ceil($this->_base / 2);

        $decrementoEspacios = ($this->_base / 2) / $this->_altura;
        
        for($i=0; $i < $this->_altura; $i++) { 

            for($j=0; $j < ($espaciado - ($i * $decrementoEspacios)); $j++) { 
                if($i <> $this->_altura -1){
                    $figura = $figura . "&nbsp";
                }
            }
       
            if($i == 0){
                $figura = $figura . "*";
            }
            else{

                $limite = $i * $incrementoPuntos;

                if($limite > $this->_base || $i == $this->_altura -1){
                    $limite = $this->_base;
                }

                for($k=0; $k < $limite; $k++) { 
                    $figura = $figura . "*";
                }
            }           
            $figura = $figura . "<br>";
        }

        echo $color . "<br>" . $figura;
    }
}

$trianguloTest = new Triangulo(8.00,7.00);

$trianguloTest->SetColor("azul");

echo $trianguloTest->ToString();

$trianguloTest->Dibujar();

?>