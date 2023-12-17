<?php
require_once('../../logica/bd.php');
$con = OpenCon();

if(empty($_POST["producto"])):
    header("Location:../panel.php?error=producto_no_existe");
    die();
endif;

$codigo = $_POST["producto"];

$nombre_prod = mysqli_query($con, "SELECT nombre FROM productos p WHERE p.codigo='$codigo'");
$nombre_producto =mysqli_fetch_array($nombre_prod);
$nombre_p = $nombre_producto['id'];

$id_prod = mysqli_query($con, "SELECT id FROM productos p WHERE p.codigo='$codigo'");
$id_producto =mysqli_fetch_array($id_prod);
$id_p = $id_producto['id'];

$sql = "DELETE FROM productos WHERE id='$id_p'";
$borrar= mysqli_query($con, $sql);

unlink("../../imagenes/productos/$nombre_p$codigo.png");

header("Location: ../index.php?seccion=panel");
die();

?>