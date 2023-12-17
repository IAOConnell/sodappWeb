<?php

 $json = file_get_contents('php://input');
 $json = json_decode($json);
 require_once('../logica/bd.php');
 $con = OpenCon();
 

   $select= "SELECT contrasena FROM usuarios WHERE usuario LIKE '$json->obj'";
   $sql= mysqli_query($con, $select);
   $c = mysqli_fetch_array($sql);
   $contrasena =  $c['contrasena'];

$respuesta = new stdClass;
 if(md5($json->pass) == $contrasena)
{
 $respuesta -> result = true;
}
 else
{
 $respuesta -> result = false;
}

echo json_encode($respuesta);
?>