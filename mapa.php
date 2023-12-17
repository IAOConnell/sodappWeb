<html>
  <head>
    <title>Directions Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <link rel="stylesheet" type="text/css" href="estilo/general/mapa.css" />
    <script type="module" src="mapa.js"></script>
  </head>
  <body>
    <div id="floating-panel">
      <b>Start: </b>
      <select id="start">
        <option value="<?php echo $_SESSION["direccion"] ?>">Mi Domicilio</option>
      </select>
      <b>End: </b>
      <select id="end">
      <?php
            $array_vendedores = [];
           if($_SESSION["tipo"] == "VENDEDOR")
            {
	            $resultado_vendedores = mysqli_query($con, "SELECT * FROM usuarios WHERE tipo = 'CLIENTE' ORDER BY id ASC");
            }
            else
            {
	            $resultado_vendedores = mysqli_query($con, "SELECT * FROM usuarios WHERE tipo = 'VENDEDOR' ORDER BY id ASC");
            }
            while($fila = mysqli_fetch_array($resultado_vendedores))
            {
                $array_vendedores[] = $fila;
            }

	        if (!empty($array_vendedores)) 
            { 
		        foreach($array_vendedores as $email=>$mail)
            {
	    ?>
        <option value="<?php echo $array_vendedores[$email]["direccion"]; ?>"><?php echo $array_vendedores[$email]["usuario"] ?></option>
        <?php
		    }
	        }
	    ?>
      </select>
    </div>
    <div id="map"></div>

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises.
      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api
      for more information.
      -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5ZZfrmjuQpTIdvMT6pKseKR_FzcaKZSY&callback=initMap&v=weekly"
      defer
    ></script>
  </body>
</html>
