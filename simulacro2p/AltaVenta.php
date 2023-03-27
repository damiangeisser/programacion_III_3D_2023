<?php
/*
Simulacro 1er Parcial - 2da parte
Alumno: Geisser, Damian
*/

require_once "./Pizza.php";
require_once "./PizzaConsultar.php";
require_once "./PDOHelper";

//Instancia una Pizza y lo agrega al archivo especificado
function CrearVenta($email, $sabor, $tipo, $cantidad)
{
    $pizzasCargadas = FileHelper::LeerJson("./Pizza.json");

   if(ConfirmarStockVenta($pizzasCargadas, $sabor, $tipo, $cantidad))
   {
        FileHelper::GuardarJson("./Pizza.json", $pizzasCargadas);
        
        $venta = new Venta()
   }
}

//Valida las existencias de las pizzas y las actualiza según los pedidos.
function ConfirmarStockVenta($pizzasEnStock, $saborPedido, $tipoPedido, $cantidadPedido)
{
    $respuesta = false;

    foreach($pizzasEnStock as $pizza)
    {
        if($pizza->_sabor == $saborPedido && $pizza->_tipo == $tipoPedido)
        {
            $respuesta = $pizza->_cantidad >= $cantidadPedido;

            $pizza->_cantidad = $pizza->_cantidad - $cantidadPedido;

            break;
        }
    }

    return $respuesta;
}

function InsertarVenta($nombre, $apellido, $localidad, $mail, $clave)
{
    $objetoPDOHelper = PDOHelper::ObtenerObjetoPDOHelper(); 
    $consulta =$objetoPDOHelper->PrepararConsulta("INSERT into venta (nombre,apellido,localidad,mail,clave,fecha_de_registro)
                                                   values(:nombre,:apellido,:localidad,:mail,:clave,:fecha_de_registro)");
    
    $consulta->bindValue(':nombre', $nombre, PDO::PARAM_INT);
    $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
    $consulta->bindValue(':localidad', $localidad, PDO::PARAM_STR);
    $consulta->bindValue(':mail', $mail, PDO::PARAM_STR);
    $consulta->bindValue(':clave',  $clave, PDO::PARAM_STR);
    $consulta->bindValue(':fecha_de_registro', date("Y-m-d"), PDO::PARAM_STR);

    $consulta->execute();	

    return $objetoPDOHelper->RetornarUltimoIdInsertado();
}

function ObtenerNumeroDePedido()
{
    $objetoPDOHelper = PDOHelper::ObtenerObjetoPDOHelper(); 
    $consulta = $objetoPDOHelper->PrepararConsulta("SELECT numero_de_pedido FROM venta ORDER BY numero_de_pedido DESC LIMIT 1");
    
    $ultimoNumeroDePedido = $consulta->execute();	

    return $ultimoNumeroDePedido;
}

?>