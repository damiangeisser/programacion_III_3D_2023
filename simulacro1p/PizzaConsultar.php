<?php
/*
Simulacro 1er Parcial - 1era parte
Alumno: Geisser, Damian
*/

require_once "./Pizza.php";

//Valida las existencias de las pizzas.
function ValidarStock($sabor, $tipo)
{

    $hayStock = false;
    $haySabor = false;
    $noHaySabor = false;

    $respuesta = "";

    $pizzas = LeerPizzas("./Pizza.json");

    foreach($pizzas as $pizza)
    {
        if($pizza->_sabor == $sabor)
        {
            if($pizza->_tipo == $tipo)
            {
                $hayStock = true;

                break;
            }
            else{
                $haySabor = true;
            } 
        }else{
            $noHaySabor = true;
        }
    }

    if($hayStock)
    {
        $respuesta = "Si Hay.";
    }
    elseif($haySabor){
        $respuesta = "Hay sabor pero no de ese tipo.";
    }
    elseif($noHaySabor){
        $respuesta = "No hay de ese sabor.";
    }

    return $respuesta;
}

//Devuelve un array de Pizza desde un archivo json
function LeerPizzas($archivo)
{
    $pizzas = array();

    if(is_file($archivo))
    {
        $contenido = file_get_contents($archivo);

        $pizzas = json_decode($contenido);   
    }

    return $pizzas;
}

?>