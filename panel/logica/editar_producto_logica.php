<?php 

function select_producto($con, $codigo_final)
{
$select = "SELECT * FROM productos WHERE codigo='$codigo_final'";
$sql= mysqli_query($con, $select);
$array = mysqli_fetch_array($sql);
return $array;
}