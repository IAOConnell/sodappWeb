<?php 
require_once('../../logica/bd.php');
require_once('editar_producto_logica.php');
$con = OpenCon();
session_start();

$nombre = trim(ucwords($_POST["nombre"])); 
$precio = $_POST["precio"];
$codigo = $_POST["codigo"];
$cantidad = $_POST["cantidad"];

$producto_get = select_producto($con, $_GET['producto']);
$codigo_get = $producto_get['codigo'];
$id_prod = mysqli_query($con, "SELECT id FROM productos p WHERE p.codigo='$codigo_get'");
$id_producto =mysqli_fetch_array($id_prod);
$id_p = $id_producto['id'];

$nombreLimpio= str_replace(" ","_", $nombre);

if(!empty($_FILES["imagen"])):

    $imagen  = $_FILES["imagen"];
    $origen  = $_FILES["imagen"]["tmp_name"];
    $destino = "../../imagenes/productos/$nombreLimpio$codigo.png";

    move_uploaded_file($origen, $destino);

endif;

$sql = "UPDATE productos SET nombre = '$nombre', precio = '$precio', codigo = '$codigo', cantidad = '$cantidad', imagen = 'imagenes/productos/$nombreLimpio$codigo.png' WHERE id='$id_p'";
$insertar= mysqli_query($con, $sql);
print_r($id_p);
header("Location: ../index.php?seccion=panel");