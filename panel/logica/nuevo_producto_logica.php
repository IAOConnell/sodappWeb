<?php 
require_once('../../logica/bd.php');
$con = OpenCon();
session_start();

$nombre = trim(ucwords($_POST["nombre"])); 
$precio = $_POST["precio"];
$codigo = $_POST["codigo"];
$cantidad = $_POST["cantidad"];

$nombreVendedor = $_SESSION["nombre"];
$id_vende = mysqli_query($con, "SELECT id FROM usuarios u WHERE u.nombre='$nombreVendedor'");
$id_vendedor = mysqli_fetch_assoc($id_vende);
$id_v = $id_vendedor['id'];

$nombreLimpio= str_replace(" ","_", $nombre);

if(!empty($_FILES["imagen"])):

    $imagen  = $_FILES["imagen"];
    $origen  = $_FILES["imagen"]["tmp_name"];
    $destino = "../../imagenes/productos/$nombreLimpio.png";

    move_uploaded_file($origen, $destino);

endif;

$sql = "INSERT INTO productos (nombre, precio, codigo, cantidad, id_vendedor, imagen) VALUES ('$nombre', '$precio', '$codigo', '$cantidad', '$id_v', 'imagenes/productos/$nombreLimpio.png')";
$insertar= mysqli_query($con, $sql);

header("Location: ../index.php?seccion=panel");