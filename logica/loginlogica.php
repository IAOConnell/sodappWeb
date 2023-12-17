<?php
session_start( );
include_once "bd.php";
$conexion = OpenCon();

$msj1="Faltan campos!";
$msj2="Datos incorrectos!";

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$query = "SELECT usuario, contrasena, nombre, apellido, telefono, tipo, email, imagen, direccion FROM usuarios WHERE usuario='$usuario' AND contrasena=MD5('$contrasena') LIMIT 1";

$envioQuery = mysqli_query($conexion, $query);
$chequeo = mysqli_fetch_assoc($envioQuery);

if( $chequeo == NULL ){

    header("Location: ../index.php?seccion=login");

}else{
		$_SESSION = $chequeo;
		header("Location: ../index.php?seccion=catalogo");
}	

?>