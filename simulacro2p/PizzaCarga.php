<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

require_once "./Pizza.php";
require_once "./FileHelper.php";

//Instancia una Pizza y lo agrega al archivo especificado
function AgregarPizza($sabor, $precio, $tipo, $cantidad, $archivo)
{
    $pizzasCargadas = FileHelper::LeerJson($archivo);

    $id = 1;

    if(count($pizzasCargadas)>0)
    {
        usort($pizzasCargadas, "ordenarIds");

        $ultimaPizza = end($pizzasCargadas);

        $id = $ultimaPizza->_id + 1;
    }

    if(!ActualizarStock($pizzasCargadas, $sabor, $precio, $tipo, $cantidad))
    {
        $nuevaPizza = new Pizza($id, $sabor, $precio, $tipo, $cantidad);

        array_push($pizzasCargadas, $nuevaPizza);
    }

    FileHelper::GuardarJson($archivo, FileHelper::ObjetosToJson($pizzasCargadas));
}

function ActualizarStock($pizzas, $sabor, $precio, $tipo, $cantidad)
{
    $respuesta = false;

    foreach($pizzas as $pizza)
    {
        if($pizza->_sabor == $sabor && $pizza->_tipo == $tipo)
        {
            $pizza->_precio = $precio;
            $pizza->_cantidad = $pizza->_cantidad + $cantidad;
            $respuesta = true;          
        }
    }

    return $respuesta;
}

function ordenarIds($id1, $id2)
{
    if ($id1 == $id2) {
        return 0;
    }
    return ($id1 < $id2) ? -1 : 1;
}

?>