<!--------------------CARRITO-------------------------->
<!------------------------BODY------------------------------>

<!--------------------CATALOGO---------------------------->

<!-- Carousel -->
<div id="carousel" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
  </div>

  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imagenes/index/sodero.png" alt="Sodero" class="d-block w-100" id="carousel-img">
      <div class="carousel-caption">
    <h3>Una aplicación para soderos</h3>
    <p>Integramos un mapa para conocer el recorrido a recorrer para tus entregas!</p>
  </div>
    </div>
    <div class="carousel-item">
      <img src="imagenes/index/botellas.jpg" alt="Botellas" class="d-block w-100" id="carousel-img">
      <div class="carousel-caption">
    <h3>La mejor calidad</h3>
    <p>Contamos con los mejores proveedores!</p>
  </div>
    </div>
    <div class="carousel-item">
      <img src="imagenes/index/bidones.jpg" alt="Bidones" class="d-block w-100" id="carousel-img">
      <div class="carousel-caption">
    <h3>Posibilidades de negocio</h3>
    <p>Cualquiera puede registrarte a Sodapp para comprar o vender! ¿Qué estás esperando?</p>
  </div>
    </div>
  </div>

  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black" id="index">
        <div class="intro">
          <div class="row">
            <div class="col-4">
              <h1>Sodapp</h1>
            </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p>Bienvenidos a Sodapp! Una plataforma en donde vas a poder encontrar soda y otras bebidas al mejor precio y a los mejores proveedores del mercado!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <h3>¿Estás interesado en vender?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p>Sodapp te proporciona una plataforma con todos los recursos necesarios para poder empezar tu negocio.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h3>Nuestros vendedores destacados:</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
          <?php
            $array_vendedores = [];
            $resultado_vendedores = mysqli_query($con, "SELECT * FROM usuarios WHERE tipo = 'VENDEDOR' ORDER BY id ASC");
              while($fila = mysqli_fetch_array($resultado_vendedores))
              {
                  $array_vendedores[] = $fila;
              }

              if (!empty($array_vendedores)) 
              { 
              foreach($array_vendedores as $email=>$mail)
              {
	    ?>
		    <div class="item-producto">
			    <div class="img-vendedor"><img width="150" height="150" src="<?php echo $array_vendedores[$email]["imagen"]; ?>"> <h2><a class="btn btn-primary" href="index.php?seccion=vendedor&vend=<?php echo $array_vendedores[$email]['usuario'] ?>"><?php echo $array_vendedores[$email]["usuario"]; ?></a><h2></div>
              </div>
	    <?php
		    }
	        }
	    ?>
          </div>
        </div>

    </div>