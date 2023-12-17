<?php

function get_id($con, $usuario)
{

   $select= "SELECT id FROM usuarios WHERE usuario LIKE '$usuario'";
   $sql= mysqli_query($con, $select);
   $id = mysqli_fetch_array($sql);
   $id_vendedor=  $id['id'];
   return $id_vendedor;
}
?>