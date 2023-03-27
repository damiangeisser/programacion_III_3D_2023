<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

require_once "./Pizza.php";
require_once "./FileHelper.php";

//Valida las existencias de las pizzas.
function ValidarStock($sabor, $tipo)
{

    $hayStock = false;
    $haySabor = false;
    $noHaySabor = false;

    $respuesta = "";

    $pizzas = FileHelper::LeerJson("./Pizza.json");

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

?>