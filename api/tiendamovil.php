<?php
    require_once('../logica/vendedor_logica.php');
session_start( );
include_once "../logica/bd.php";
$con = OpenCon();
$usuarioVendedor = $_GET['vend'];
$usuarioMovil = $_GET['usu'];
$usuarioVendedorResultado= get_id($con, $usuarioVendedor);
$url = 

$query = "SELECT usuario, contrasena, nombre, apellido, telefono, tipo, email, imagen, direccion FROM usuarios WHERE usuario='$usuarioMovil' LIMIT 1";
$envioQuery = mysqli_query($con, $query);
$chequeo = mysqli_fetch_assoc($envioQuery);
if( $chequeo == NULL ){

    header("Location: ../index.php?seccion=login");

}else{
		$_SESSION = $chequeo;
		header("Location: ../index.php?seccion=vendedor&vend=$usuarioVendedor");
}

$agenda = "";
?>
<!------------------------BODY------------------------------>
<body class="d-flex flex-column min-vh-100">

<!--------------------CARRITO-------------------------->
<?php
        if(isset($_SESSION["usuario"])):
    ?>
    <div id="shopping-cart">
    <div><h1>Carrito</h1></div>
    <a id="botonVaciar" href="index.php?seccion=vendedor&vend=<?php echo $usuarioVendedor ?>&accion=vaciar">Vaciar Carrito</a>

<?php
    if(isset($_SESSION["item_carrito"])){
        $cantidad_total = 0;
        $precio_total = 0;
?>	
<table class="tabla-carrito" cellpadding="10" cellspacing="1">
    <tbody>
        <tr>
            <th style="text-align:left;">Nombre</th>
            <th style="text-align:left;">Código</th>
            <th style="text-align:right;" width="5%">Cantidad</th>
            <th style="text-align:right;" width="10%">Precio</th>
            <th style="text-align:right;" width="10%">Precio total</th>
            <th style="text-align:center;" width="5%">Quitar</th>
        </tr>	
        <?php		
            foreach ($_SESSION["item_carrito"] as $item)
            {
                $item_precio = $item["cantidad"]*$item["precio"];
		        ?>
			        <tr>
				        <td><img width="150" height="150" src="<?php echo $item["imagen"]; ?>" class="imagen-item-carrito" /><?php echo $item["nombre"]; ?></td>
				        <td><?php echo $item["codigo"]; ?></td>
				        <td style="text-align:right;"><?php echo $item["cantidad"]; ?></td>
				        <td  style="text-align:right;"><?php echo "$ ".$item["precio"]; ?></td>
				        <td  style="text-align:right;"><?php echo "$ ". number_format($item_precio,2); ?></td>
				        <td style="text-align:center;"><a href="index.php?seccion=vendedor&vend=<?php echo $usuarioVendedor ?>&accion=quitar&codigo=<?php echo $item["codigo"]; ?>" class="botonQuitarAccion"><img src="imagenes/interfaz/icon-delete.png" alt="Quitar item" /></a></td>
			    	</tr>
			    	<?php
			    	$cantidad_total += $item["cantidad"];
			    	$precio_total += ($item["precio"]*$item["cantidad"]);
		    }
	    ?>
        <tr>
            <td colspan="2" align="right">Total:</td>
            <td align="right"><?php echo $cantidad_total; ?></td>
            <td align="right" colspan="2"><strong><?php echo "$ ".number_format($precio_total, 2); ?></strong></td>
            <td></td>
        </tr>
        <div id="wallet_container">
    </div>
    <script>
      const mp = new MercadoPago('TEST-bdb48fb4-14e5-441d-b056-ff5fbb6f0784', {
        locale: 'es-AR'
      });

      mp.bricks().create("wallet", "wallet_container", {
        initialization: {
        preferenceId: "<?php echo $preference -> id; ?>",
        },
      });
    </script>
    </tbody>
</table>
<form  action="logica/compra_logica.php?vendedor=<?php echo $usuarioVendedor?>&total=<?php echo $precio_total ?>" method="POST">
        <tr>
            <td>Agendar compra?
            <div class="form-check">
                <input type="radio" name="flexRadioAgenda" value="SI" id="flexRadioTipo1" class="form-check-input" <?php if (isset($_POST['radio']) && $_POST['radio'] == 'SI'): ?>checked='checked'<?php endif; ?> /> Si
            </div>
            <div class="form-check">
                <input type="radio" name="flexRadioAgenda" value="NO" id="flexRadioTipo1" class="form-check-input" <?php if (isset($_POST['radio']) && $_POST['radio'] == 'NO'): ?>checked='checked'<?php endif; ?> /> No
            </div>
            </td>
            <td>
            <select class="form-select" id="dia" name="dia">
                <option value="Domingo">Domingo</option>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
            </select>
            <input type="text" name="hora" class="form-control input_user" placeholder="hora">
            </td>
        </tr>
        <button class="btn btn-primary" type="submit">Comprar y Agendar</button>
</form>	
  <?php
}else {
?>
    <div class="no-hay-nada">El carrito esta vacío</div>
<?php 
    }
?>
</div>

<?php
endif;
?>


<!--------------------CATALOGO---------------------------->
<div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black">
    <!-------------------------RESULTADOS PRODUCTOS---------------------->
    <div id="grilla-productos">
	    <div class="txt-heading">Productos</div>
	    <?php
            $array_productos = [];
	        $resultado = mysqli_query($con, "SELECT * FROM productos WHERE id_vendedor = $usuarioVendedorResultado ORDER BY id ASC");
            while($fila = mysqli_fetch_array($resultado))
            {
                $array_productos[] = $fila;
            }

	        if (!empty($array_productos)) 
            { 
		        foreach($array_productos as $codigo=>$valor)
            {
	    ?>
		    <div class="item-producto">
			    <form method="post" action="index.php?seccion=vendedor&vend=<?php echo $usuarioVendedor ?>&accion=meter&&codigo=<?php echo $array_productos[$codigo]["codigo"]; ?>">
			        <div class="product-image"><img width="150" height="150" src="<?php echo $array_productos[$codigo]["imagen"]; ?>"></div>
			        <div class="product-tile-footer">
			            <div class="product-title"><?php echo $array_productos[$codigo]["nombre"]; ?></div>
			            <div class="product-price"><?php echo "$".$array_productos[$codigo]["precio"]; ?></div>
			            <div class="cart-action"><input type="text" class="cantidad-producto" name="cantidad" value="1" size="2" /><input type="submit" value="Agregar al Carrito" class="botonAgregarAccion" /></div>
			        </div>
			    </form>
		    </div>
	    <?php
		    }
	        }
	    ?>
    </div>
</div>