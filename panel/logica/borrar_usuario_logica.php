<?php
require_once('../../logica/bd.php');
$con = OpenCon();

if(empty($_POST["usuario"])):
    header("Location:../panel.php?error=usuario_no_existe");
    die();
endif;

$email = $_POST["usuario"];

$nombre_usu = mysqli_query($con, "SELECT nombre FROM usuarios u WHERE u.email='$email'");
$nombre_usuario =mysqli_fetch_array($nombre_prod);
$nombre_u = $nombre_usuario['id'];

$id_usu = mysqli_query($con, "SELECT id FROM usuarios u WHERE u.email='$email'");
$id_usuario =mysqli_fetch_array($id_usu);
$id_u = $id_usuario['id'];

$sql = "DELETE FROM usuarios WHERE id='$id_u'";
$borrar= mysqli_query($con, $sql);

unlink("../../imagenes/perfil/$nombre_u.png");

header("Location: ../index.php?seccion=panel");
die();

?>