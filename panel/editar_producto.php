<html lang="es">
<?php
require_once('../logica/bd.php');
require_once('logica/editar_producto_logica.php');

$con = OpenCon();
session_start();
if($_SESSION["tipo"] == "VENDEDOR"){
$codigoProducto= select_producto($con, $_GET['producto']);
}
?>

<head>
    <meta charset="UTF-8">
    <title>Sodapp</title>

        <!--Bootstrap y CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link href="estilo/burbujas/style.css" rel="stylesheet">
        <link rel="stylesheet" href="../estilo/general/estilo.css" type="text/css" />

       <!--Efecto Burbujas-->
       <link rel="stylesheet" href="../estilo/burbujas/movingbubbles.css" type="text/css" />
       <script src="../estilo/burbujas/movingbubbles.js" type="text/javascript"></script>
</head>


<!------------------------BODY------------------------------>
<body class="d-flex flex-column min-vh-100">
    
<!----------------------NAVBAR------------------------------>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>   
        </button>
       
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?seccion=catalogo">Inicio</a>
                    </li>
                <?php
                    if(empty($_SESSION["usuario"])):
                ?>
                    <li class="nav-item">
                        <a href="../index.php?seccion=registro" class="nav-link">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.php?seccion=login" class="nav-link">Conectarse</a>
                    </li>
                <?php
                else:
                ?>
                    <li class="nav-item">
                        <a href="../index.php?seccion=perfil" class="nav-link"><?php echo isset($_SESSION["usuario"]) ?  $_SESSION["usuario"] : "" ?></a>
                    </li>             
                    <?php
                    if($_SESSION["tipo"] != "CLIENTE"){ ?>
                     <li class="nav-item">
                            <a href="panel/index.php?seccion=panel" class="nav-link">Panel de Control</a>
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
        <div class="search-container">
            <form action="../logica/busqueda.php" method="post">
                <input class="searchInput" type="text" placeholder="Search.." name="busqueda">
                <button type="submit">Submit</button>
            </form>
        </div>
            </div>
    </nav>


<!-------------------FORMULARIO------------------->


<?php
    if($_SESSION["tipo"] == "VENDEDOR"){ ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="justificado">Editar Producto</h1>
        </div>
    </div>
</div>

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-6 col-xl-4 mx-5 mt-1 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="logica/editar_producto_logica_2.php?producto=<?php echo $codigoProducto['codigo']; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="justificado" for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Producto" value="<?= $codigoProducto['nombre']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="justificado" for="precio">Precio</label>
                                <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio del Producto" value="<?= $codigoProducto['precio']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="justificado" for="codigo">Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código del Producto" value="<?= $codigoProducto['codigo']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="justificado" for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad en Stock" value="<?= $codigoProducto['cantidad']; ?>">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                  <label for="imagen"></label>
                                  <input type="file" class="form-control-file" name="imagen" id="imagen" aria-describedby="fileHelpId">
                                </div>
                                <?php
                                    if(isset($codigoProducto['imagen'])):
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <img src="../<?= $codigoProducto['imagen']; ?>" alt="imagen" class="img-fluid">
                                    </div>
                                </div>
                                <?php
                                    endif;
                                ?>
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