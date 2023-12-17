<?php
include_once "bd.php";
$c= OpenCon();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$tipo =  $_POST['flexRadioTipo'];

$query ="INSERT INTO usuarios (nombre, apellido, email, telefono, usuario, contrasena, tipo, imagen, direccion) VALUES ('$nombre','$apellido','$email','$telefono','$usuario',MD5('$contrasena'),'$tipo', 'imagenes/perfil/profile.png', '')";

mysqli_query($c, $query);
header("Location:../index.php?seccion=login");
exit();
?>