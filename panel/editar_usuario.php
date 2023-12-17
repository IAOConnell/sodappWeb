<html lang="es">
<?php
require_once('../logica/bd.php');
require_once('logica/editar_usuario_logica.php');

$con = OpenCon();
session_start();
if($_SESSION["tipo"] == "ADMIN"){
$emailUsuario= select_usuario($con, $_GET['usuario']);
}
//print_r($codigoProducto);
?>

<head>
    <meta charset="UTF-8">
    <title>Sodapp</title>
    <!--color NavBar: #0D6EFD -->

        <!--Bootstrap y CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link href="estilo/burbujas/style.css" rel="stylesheet">
        <link rel="stylesheet" href="../estilo/general/estilo.css" type="text/css" />

       <!--Efecto Burbujas-->
       <link rel="stylesheet" href="../estilo/burbujas/movingbubbles.css" type="text/css" />
       <script src="../estilo/burbujas/movingbubbles.js" type="text/javascript"></script>

<?php
$seccion="editar_producto";
// Acá veo si estoy agregando o editando

//if(!empty($_GET["producto"])):
    // Si estoy editando...
   // $titulo = "Editar Producto";
    //$boton  = "Editar";
    //$action = "editar_producto_logica.php";
    
    //$nombre = ucwords($_GET["producto"]);
    
    // Revisamos que exista
    //$array_productos = [];
    //$nombre = $_SESSION["nombre"];
    //$previa = mysqli_query($con, "SELECT id FROM productos p WHERE p.nombre='$nombre'");
    //$prod = mysqli_fetch_assoc($previa);

    //if(mysqli_fetch_assoc($previa) != $prod)
    //{
      //  header("location:panel.php?seccion=nuevo&estado=error&error=existe");
        //die();
    //}


    // Lo traigo

   // $descripcion = file_get_contents("../county/$nombre/descripcion.txt");
    
   // if(is_file("../county/$nombre/$nombre.png")):
   //     $imagen = "../county/$nombre/$nombre.png";
   // endif;

//endif;
?>
</head>


<!------------------------BODY------------------------------>
<body class="d-flex flex-column min-vh-100">
    
<!----------------------NAVBAR------------------------------>
    <nav class="navbar bg-primary navbar-expand-lg navbar-dark navbar-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>   
        </button>
       
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Inicio</a>
                    </li>
            </ul>
                <?php
                    if(empty($_SESSION["usuario"])):
                ?>
                <ul class="navbar-nav mr-0">
                    <li class="nav-item">
                        <a href="registro.php" class="nav-link">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Conectarse</a>
                    </li>
                </ul>
                <?php
                else:
                ?>
                <ul class="navbar-nav mr-0">
                    <li class="nav-item">
                        <a href="../perfil.php" class="nav-link"><?php echo isset($_SESSION["usuario"]) ?  $_SESSION["usuario"] : "" ?></a>
                    </li>
                    <?php
                    if($_SESSION["tipo"] != "CLIENTE"){ ?>
                     <li class="nav-item">
                            <a href="panel/panel.php" class="nav-link">Panel de Control</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="../logica/logoutLogica.php" class="nav-link">Salir</a>
                    </li>

                </ul>   
            <?php
                endif;
            ?>     
        </div>
    </nav>


<!-------------------FORMULARIO------------------->


<?php
    if($_SESSION["tipo"] == "ADMIN"){ ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="justificado">Editar Usuario</h1>
        </div>
    </div>
</div>

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-6 col-xl-4 mx-5 mt-1 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="logica/editar_usuario_logica_2.php?email=<?php echo $emailUsuario['email']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                                <label class="justificado" for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de Usuario" value="<?= $emailUsuario['usuario']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="justificado" for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?= $emailUsuario['nombre']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="justificado" for="precio">Apellido</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="<?= $emailUsuario['apellido']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="justificado" for="codigo">Teléfonoo</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Número de teléfono" value="<?= $emailUsuario['telefono']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="justificado" for="cantidad">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Dirección de e-mail" value="<?= $emailUsuario['email']; ?>">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                  <label for="imagen"></label>
                                  <input type="file" class="form-control-file" name="imagen" id="imagen" aria-describedby="fileHelpId">
                                </div>
                                <?php
                                    if(isset($emailUsuario['imagen'])):
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <img src="../<?= $emailUsuario['imagen']; ?>" alt="imagen" class="img-fluid">
                                    </div>
                                </div>
                                <?php
                                    endif;
                                ?>
                            </div>
                            <div class="row">
                                <p>Tipo de usuario:</p>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="flexRadioTipo" value="CLIENTE" id="flexRadioTipo1" class="form-check-input" <?php if (isset($_POST['radio']) && $_POST['radio'] == 'cliente'): ?>checked='checked'<?php endif; ?> /> Cliente
                            </div>
                            <div class="form-check">
                                <input type="radio" name="flexRadioTipo" value="VENDEDOR" id="flexRadioTipo2" class="form-check-input" <?php if (isset($_POST['radio']) && $_POST['radio'] == 'vendedor'): ?>checked='checked'<?php endif; ?> /> Vendedor
                            </div>
                            <div class="form-check">
                                <input type="radio" name="flexRadioTipo" value="ADMIN" id="flexRadioTipo3" class="form-check-input" <?php if (isset($_POST['radio']) && $_POST['radio'] == 'admin'): ?>checked='checked'<?php endif; ?> /> Admin
                            </div>
                            <button type="submit" class="btn btn-secondary btn-block">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

 <?php } 
 else {
?>
    <article class="col-12">
    <div class="card">
        <div class="card-header">
            <h1 class="text-secondary card-title">ACCSESO DENEGADO</h1>
        </div>
        <p>No tienes permisos para ver esta página</p>
    </div>
    </article>
<?php
} ?>

<!-------------------------FOOTER------------------->
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 fixed-bottom mt-auto" style="background-color:white">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Sodapp</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex" style="margin-right: 15px;">
      <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../imagenes/footer/instagram.png"></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../imagenes/footer/facebook.png"></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../imagenes/footer/twitter.png"></a></li>
    </ul>
  </footer>
</body>
</html>