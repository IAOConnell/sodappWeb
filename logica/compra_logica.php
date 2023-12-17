<?php 
require_once('bd.php');
$con = OpenCon();
session_start();

$total = $_GET["total"];
$vendedor = $_GET["vendedor"];
$comprador = $_SESSION["usuario"];
$agenda =  $_POST['flexRadioAgenda'];
$dia =  $_POST['dia'];
$hora =  $_POST['hora'];


function get_id_vendedor($con, $usuario)
{

   $select= "SELECT id FROM usuarios WHERE usuario LIKE '$usuario'";
   $sql= mysqli_query($con, $select);
   $id = mysqli_fetch_array($sql);
   $id_vendedor=  $id['id'];
   return $id_vendedor;
}

function get_id_comprador($con, $usuario)
{

   $select= "SELECT id FROM usuarios WHERE usuario LIKE '$usuario'";
   $sql= mysqli_query($con, $select);
   $id = mysqli_fetch_array($sql);
   $id_comprador=  $id['id'];
   return $id_comprador;
}

function get_id_compra($con)
{
$id_compra= $con->insert_id;
return $id_compra;
}

function get_id_producto($con, $codigo, $vendedor)
{
   $select= "SELECT id FROM productos p WHERE codigo LIKE '$codigo' AND id_vendedor = '$vendedor'";
   $sql= mysqli_query($con, $select);
   $id = mysqli_fetch_array($sql);
   $id_producto=  $id['id'];
   return $id_producto;
}

function get_cantidad_producto($con, $codigo, $vendedor)
{
   $select= "SELECT cantidad FROM productos p WHERE codigo LIKE '$codigo' AND id_vendedor = '$vendedor'";
   $sql= mysqli_query($con, $select);
   $c = mysqli_fetch_array($sql);
   $cantidad_prod=  $c['cantidad'];
   return $cantidad_prod;
}

$id_v = get_id_vendedor($con, $vendedor);
$id_c = get_id_comprador($con, $comprador);


$sql = "INSERT INTO compras (id_comprador, id_vendedor, monto) VALUES ('$id_c', '$id_v', '$total')";
$insertar= mysqli_query($con, $sql);
$id_comp = get_id_compra($con);

foreach ($_SESSION["item_carrito"] as $item)
{
    $item_precio = $item["cantidad"]*$item["precio"];
    $item_cantidad = $item["cantidad"];
    $producto_codigo = $item['codigo'];
    $producto_id = get_id_producto($con, $producto_codigo, $id_v);

   $producto_sql = "INSERT INTO compras_detalle (id_producto, codigo_producto, precio, cantidad, id_comprador, id_vendedor, id_compra) VALUES ('$producto_id', '$producto_codigo', '$item_precio', '$item_cantidad', '$id_c', '$id_v', '$id_comp')";
   $insertar= mysqli_query($con, $producto_sql);
}

$cantidad_stock = get_cantidad_producto($con, $producto_codigo, $id_v);
$cantidad_restante = $cantidad_stock - $item["cantidad"];
$id_prod = get_id_producto($con, $producto_codigo, $id_v);
$sql_cantidad = "UPDATE productos SET cantidad = '$cantidad_restante' WHERE id='$id_prod'";
$insertar= mysqli_query($con, $sql_cantidad);

if($agenda == "SI")
{
   switch ($dia)
{
    case "Domingo":
        $d_id = 1;
        break;
    case "Lunes":
         $d_id = 2;
        break;
    case "Martes":
        $d_id = 3;
        break;
    case "Miércoles":
         $d_id = 4;
        break;
    case "Jueves":
         $d_id = 5;
        break;
    case "Viernes":
         $d_id = 6;
        break;
    case "Sábado":
         $d_id = 7;
        break;
    default:
    unset($_SESSION["item_carrito"]);
    require_once('catalogo.php');
    set_error_handler($err, $errpr);
    break;
 } 
   $sql_agenda = "INSERT INTO compras_agenda (id_compra, dia, hora, d_id) VALUES ('$id_comp', '$dia', '$hora', '$d_id')";
   $insertar_agenda = mysqli_query($con, $sql_agenda);
}

unset($_SESSION["item_carrito"]);
header("Location:../index.php?seccion=vendedor&vend=$vendedor");