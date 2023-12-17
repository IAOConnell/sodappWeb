<?php
    session_start();
    require_once('../logica/bd.php');
    $con = OpenCon();
?>

<html lang="es">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sodapp</title>
    <!--color NavBar: #0D6EFD -->

        <!--Bootstrap y CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link href="../estilo/burbujas/style.css" rel="stylesheet">
        <link rel="stylesheet" href="../estilo/general/estilo.css" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <a href="../index.php?seccion=mapa" class="nav-link">Mapa</a>
                    </li> 
                     <li class="nav-item">
                            <a href="index.php?seccion=panel" class="nav-link">Panel de Control</a>
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
<!----------------------------------------------------->
<?php
switch ($_GET['seccion'])
{
    case "login":
        require_once('../login.php');
        break;
    case "registro":
        require_once('../registro.php');
        break;
    case "perfil":
        require_once('../perfil.php');
        break;
    case "catalogo":
        require_once('../catalogo.php');
        break;
    case "nuevo_producto":
        require_once('nuevo_producto.php');
        break;
    case "panel":
        require_once('panel.php');
        break;
    case "mapa":
        require_once('mapa.php');
        break;
    default:
    require_once('panel.php');
    break;
 } 
?>

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