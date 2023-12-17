<?php

 $json = file_get_contents('php://input');
 $json = json_decode($json);
 require_once('../logica/bd.php');
 $con = OpenCon();
 

   $query = "SELECT usuario, contrasena, nombre, apellido, telefono, tipo, email, imagen, direccion FROM usuarios WHERE usuario='$json->usu' LIMIT 1";
     $envioQuery = mysqli_query($conexion, $query);
    $chequeo = mysqli_fetch_assoc($envioQuery);
    
    $respuesta = new stdClass;
    if( $chequeo == NULL ){

    $respuesta -> result = false;

    }else{
		$_SESSION = $chequeo;
		$respuesta -> result = true;
    }

echo json_encode($respuesta);

?>