<?php     session_start();
    require_once('logica/catalogo.php');
    require_once('logica/vendedor_logica.php');
    require __DIR__  . '/vendor/autoload.php'; ?>

<html lang="es">
    
<script src="https://sdk.mercadopago.com/js/v2">
    </script>


<?php

    MercadoPago\SDK::setAccessToken("TEST-6029288139074599-110215-ef4c5b7e056bd8de51b4f11ecc0c3afa-476961876");

    $preference = new MercadoPago\Preference();
    if (isset($_SESSION['item_carrito'])){
        $array = array();
        $total = 0;
    foreach ($_SESSION["item_carrito"] as $prod)
    {
        $item = new MercadoPago\Item();
        $item->id = $prod['codigo'];
        $item->title = $prod['nombre'];
        $item->currency_id = 'ARS';
        $item->picture_url = 'https://www.mercadopago.com/org-img/MP3/home/logomp3.gif';
        $item->description = '';
        $item->category_id = 'art';
        $item->quantity = $prod['cantidad'];
        $item->unit_price= $prod['precio'];

        $total += $prod['precio'];
        array_push($array , $item);
    }

    }

    if (!empty($array)){
    $preference->items = $array;

          // Informacion del comprador
          if (isset($_SESSION["usuario"])){

            $payer = new MercadoPago\Payer();
            $payer->name = $_SESSION["nombre"];
            $payer->surname = $_SESSION["apellido"];
            $payer->email = $_SESSION["email"];
            $payer->phone = array(
                'area_code' => '11',
                'number' => $_SESSION["telefono"]
            );
            $payer->identification = array(
                'type' => 'DNI',
                'number' => '39066002'
            );
            $payer->address = array(
                'street_name' => 'Street',
                'street_number' => 123,
                'zip_code' => '06233200'
            );

          }
          else{
          $payer = new MercadoPago\Payer();
          $payer->name = 'João';
          $payer->surname = 'Silva';
          $payer->email = 'user@email.com';
          $payer->phone = array(
              'area_code' => '11',
              'number' => '4444-4444'
          );
          $payer->identification = array(
              'type' => 'CPF',
              'number' => '19119119100'
          );
          $payer->address = array(
              'street_name' => 'Street',
              'street_number' => 123,
              'zip_code' => '06233200'
          );
        }
          $preference->payer = $payer;


        if($_GET['seccion'] == 'vendedor')
          {
          $preference->notification_url = 'http://localhost/sodapp/index.php?seccion=vendedor&vend=$vendedor';
          $preference->statement_descriptor = $_GET['vend'];
          $preference->external_reference = 'Reference_1234';
          $preference->expires = false;
        }
        else
        {
         $preference->notification_url = 'https://www.your-site.com/ipn';
         $preference->statement_descriptor = 'MEUNEGOCIO';
         $preference->external_reference = 'Reference_1234';
         $preference->expires = false;
        }

        // URLs de retorno
        if($_GET['seccion'] == 'vendedor')
        {
        $back_urls = array(
        'success' => "http://localhost/sodapp/logica/compra_logica.php?vendedor={$_GET['vend']}&total={$total}",
        'failure' => 'http://localhost/sodapp/index.php?seccion=vendedor&vend=$vendedor',
        'pending' => 'http://localhost/sodapp/index.php?seccion=vendedor&vend=$vendedor'
        );
        }
    else
    {
        $back_urls = array(
            'success' => "www.success.com",
            'failure' => 'www.failure.com',
            'pending' => 'www.pending.com'
            );  
    }
        $preference->back_urls = $back_urls;


          $preference->save();
        }

          set_error_handler(function(int $errno, string $errstr) {
            if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
                return false;
            } else {
                return true;
            }
        }, E_WARNING);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sodapp</title>
    <!--color NavBar: #0D6EFD -->

        <!--Bootstrap y CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link href="estilo/burbujas/style.css" rel="stylesheet">
        <link rel="stylesheet" href="estilo/general/estilo.css" type="text/css" />
       <!-- <link rel="stylesheet" href="estilo/general/mapa.css" type="text/css" /> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

       <!--Efecto Burbujas-->
       <link rel="stylesheet" href="estilo/burbujas/movingbubbles.css" type="text/css" />
       <script src="estilo/burbujas/movingbubbles.js" type="text/javascript"></script>
       <script src="https://sdk.mercadopago.com/js/v2"></script>

</head>
<!----------------------NAVBAR------------------------------>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>   
        </button>
       
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?seccion=catalogo">Inicio</a>
                    </li>
                <?php
                    if(empty($_SESSION["usuario"])):
                ?>
                    <li class="nav-item">
                        <a href="index.php?seccion=registro" class="nav-link">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?seccion=login" class="nav-link">Conectarse</a>
                    </li>
                <?php
                else:
                ?>
                    <li class="nav-item">
                        <a href="index.php?seccion=perfil" class="nav-link"><?php echo isset($_SESSION["usuario"]) ?  $_SESSION["usuario"] : "" ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?seccion=mapa" class="nav-link">Mapa</a>
                    </li>                          
                    <?php
                    if($_SESSION["tipo"] != "CLIENTE"){ ?>
                     <li class="nav-item">
                            <a href="panel/index.php?seccion=panel" class="nav-link">Panel de Control</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="logica/logoutLogica.php" class="nav-link">Salir</a>
                    </li>
                </ul>   
            <?php
                endif;
            ?>
        </div>
        <div class="search-container">
            <form action="logica/busqueda.php" method="post">
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
        unset($_SESSION["item_carrito"]);
        require_once('login.php');
        break;
    case "registro":
        unset($_SESSION["item_carrito"]);
        require_once('registro.php');
        break;
    case "perfil":
        unset($_SESSION["item_carrito"]);
        require_once('perfil.php');
        break;
    case "vendedor":
        require_once('vendedor.php');
        break;
    case "mapa":
        require_once('mapa.php');
        break;
    case "detalles":
        require_once('detalles.php');
        break;
    default:
    unset($_SESSION["item_carrito"]);
    require_once('catalogo.php');
    set_error_handler($err, $errpr);
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
      <li class="ms-3"><a class="text-body-secondary" href="#"><img src="imagenes/footer/instagram.png"></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><img src="imagenes/footer/facebook.png"></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><img src="imagenes/footer/twitter.png"></a></li>
    </ul>
  </footer>


  <!---GOOGLE MAPS---->
<script src="mapa.js"></script>
<script>
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "AIzaSyC5ZZfrmjuQpTIdvMT6pKseKR_FzcaKZSY",
    v: "weekly",
    language: 'es-419',
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });
</script>
</body>
</html>