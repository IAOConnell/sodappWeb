<?php
session_start();
include_once "bd.php";
$c= OpenCon();

if(!empty($_FILES["imagen"])):

    $nombre_usuario = $_SESSION["usuario"];
    $imagen  = $_FILES["imagen"];
    $origen  = $_FILES["imagen"]["tmp_name"];
    $destino = "../imagenes/perfil/$nombre_usuario.png";
    $destino_query = "imagenes/perfil/$nombre_usuario.png";

    move_uploaded_file($origen, $destino);
    $query= "UPDATE usuarios SET imagen='$destino_query' WHERE usuario='$nombre_usuario'";
    mysqli_query($c, $query);

endif;

$_SESSION['imagen'] = $destino_query;

header("Location:../index.php?seccion=perfil");
?>