<?php 

function select_usuario($con, $email_final)
{
$select = "SELECT * FROM usuarios WHERE email='$email_final'";
$sql= mysqli_query($con, $select);
$array = mysqli_fetch_array($sql);
return $array;
}