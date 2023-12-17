<?php

require_once('bd.php');
$con = OpenCon();
session_start();

$busqueda = $_POST["busqueda"]; 
header("Location:../resultados.php?resultados=$busqueda");
?>