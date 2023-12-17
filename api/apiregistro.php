<?php



 $json = file_get_contents('php://input');
 $json = json_decode($json);
 require_once('../logica/bd.php');
 $con = OpenCon();
 

   $query= "INSERT INTO usuarios (usuario, contrasena, nombre, apellido, telefono, tipo, email, imagen, direccion) VALUES ('$json->obj', '$json->pass', '$json->nombre', '$json->apellido', '$json->telefono', 'CLIENTE', '$json->email', 'imagenes/perfil/profile.png', '')";
   mysqli_query($con, $query);

echo json_encode($respuesta);
?>