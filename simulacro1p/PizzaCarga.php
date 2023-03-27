<?php
/*
Simulacro 1er Parcial - 1era parte
Alumno: Geisser, Damian
*/

require_once "./Pizza.php";

//Instancia una Pizza y lo agrega al archivo especificado
function AgregarPizza($sabor, $precio, $tipo, $cantidad, $archivo)
{
    $pizzasCargadas = LeerPizzas($archivo);

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

    $archivoPizzas = fopen($archivo, 'w');

    fputs($archivoPizzas, PizzasToJson($pizzasCargadas));

    fclose($archivoPizzas);
}

//Codifica un array de Pizza a Json.
function PizzasToJson($pizzas)
{
    $pizzasJson = json_encode($pizzas);

    return $pizzasJson;
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

function ActualizarStock($pizzas, $sabor, $precio, $tipo, $cantidad)
{
    $respuesta = false;

    foreach($pizzas as $pizza)
    {
        if($pizza->_sabor == $sabor)
        {
            if($pizza->_tipo == $tipo)
            {
                $pizza->_precio = $precio;

                $pizza->_cantidad = $pizza->_cantidad + $cantidad;

                $respuesta = true;
            }
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