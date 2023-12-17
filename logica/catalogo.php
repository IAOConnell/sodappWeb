<?php
require_once('bd.php');
$con = OpenCon();

if(!empty($_GET["accion"])) 
{
    switch($_GET["accion"]) 
    {
        case "meter":
            if(!empty($_POST["cantidad"])) 
            {
                $codigoProducto = runQuery($con, "SELECT * FROM productos WHERE codigo='" . $_GET["codigo"] . "'");
                $itemArray = array($codigoProducto[0]["codigo"]=>array('nombre'=>$codigoProducto[0]["nombre"], 'codigo'=>$codigoProducto[0]["codigo"], 'cantidad'=>$_POST["cantidad"], 'precio'=>$codigoProducto[0]["precio"], 'imagen'=>$codigoProducto[0]["imagen"]));
                if(!empty($_SESSION["item_carrito"])) 
                {
                    if(in_array($codigoProducto[0]["codigo"],array_keys($_SESSION["item_carrito"]))) 
                    {
                        foreach($_SESSION["item_carrito"] as $k => $v) 
                        {
                                if($codigoProducto[0]["codigo"] == $k) 
                                {
                                    if(empty($_SESSION["item_carrito"][$k]["cantidad"])) 
                                    {
                                        $_SESSION["item_carrito"][$k]["cantidad"] = 0;
                                    }
                                    $_SESSION["item_carrito"][$k]["cantidad"] += $_POST["cantidad"];
                                }
                        }
                    }
                     else 
                    {
                        $_SESSION["item_carrito"] = array_merge($_SESSION["item_carrito"],$itemArray);
                    }
                }
                 else 
                {
                    $_SESSION["item_carrito"] = $itemArray;
                }
            }
        break;

        case "quitar":
            if(!empty($_SESSION["item_carrito"])) 
            {
                foreach($_SESSION["item_carrito"] as $k => $v) 
                {
                        if($_GET["codigo"] == $k)
                            unset($_SESSION["item_carrito"][$k]);			
                        if(empty($_SESSION["item_carrito"]))
                            unset($_SESSION["item_carrito"]);
                }
            }
        break;

        case "vaciar":
            unset($_SESSION["item_carrito"]);
        break;	
    }
}
?>