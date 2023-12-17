<?php 
require_once('../../logica/bd.php');
require_once('editar_usuario_logica.php');
$con = OpenCon();
session_start();

$usuario = trim(ucwords($_POST["usuario"])); 
$nombre = $_POST["nombre"]; 
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];
$tipo =  $_POST['flexRadioTipo'];


$usuario_get = select_usuario($con, $_GET['email']);
$email_get = $usuario_get['email'];
$id_usu = mysqli_query($con, "SELECT id FROM usuarios u WHERE u.email='$email_get'");
$id_usuario =mysqli_fetch_array($id_usu);
$id_u = $id_usuario['id'];

$nombreLimpio= str_replace(" ","_", $usuario);

if(!empty($_FILES["imagen"])):

    $imagen  = $_FILES["imagen"];
    $origen  = $_FILES["imagen"]["tmp_name"];
    $destino = "../../imagenes/perfil/$nombreLimpio.png";

    move_uploaded_file($origen, $destino);

endif;

//$sql = "UPDATE usuarios SET usuario = '$usuario', nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', email='$email' tipo = '$tipo', imagen = 'imagenes/perfil/$nombreLimpio.png' WHERE id='$id_u'";
$sql = "UPDATE usuarios SET usuario = '$usuario', nombre='$nombre', apellido='$apellido', telefono='$telefono', email='$email', imagen='imagenes/perfil/$nombreLimpio.png', tipo='$tipo' WHERE id='$id_u'";
$insertar= mysqli_query($con, $sql);
print_r($sql);
//die();

header("Location: ../index.php?seccion=panel");