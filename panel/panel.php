<html lang="es">

<!------------------------BODY------------------------------>
<body class="d-flex flex-column min-vh-100">

<!----------------------CONTENIDO ADMIN------------->

<?php if($_SESSION["tipo"] == "ADMIN")
{ ?>

<article class="col-12">
    <div class="card">
        <div class="card-header">
            <h1 class="text-secondary card-title">Usuarios</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm fs-90">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php
                    $array_usuarios = [];
	                $resultado = mysqli_query($con, "SELECT * FROM usuarios ORDER BY id ASC");
                    while($fila = mysqli_fetch_array($resultado))
                    {
                        $array_usuarios[] = $fila;
                    }
	                if (!empty($array_usuarios)) 
                    { 
		                foreach($array_usuarios as $id=>$u)
                        {
	                ?>
                        <tr>
                            <td class="py-3"><img width="200" src="../<?php echo $array_usuarios[$id]["imagen"]; ?>"><h2><?php echo $array_usuarios[$id]["usuario"]; ?></h2></td>
                            <td class="py-3"><p><?php echo $array_usuarios[$id]["nombre"]; ?></p></td>
                            <td class="py-3"><p><?php echo $array_usuarios[$id]["apellido"]; ?></p></td>
                            <td class="py-3"><p><?php echo $array_usuarios[$id]["telefono"]; ?></p></td>
                            <td class="py-3"><p><?php echo $array_usuarios[$id]["tipo"]; ?></p></td>
                            <td class="py-3"><p><?php echo $array_usuarios[$id]["email"]; ?></p></td>
                            <td class="py-3">
                            <div class="separador2">
                                <a class="btn btn-sm btn-primary" href="editar_usuario.php?usuario=<?php echo $array_usuarios[$id]["email"]; ?>">Editar</a>
                            </div>
                            <form action="logica/borrar_usuario_logica.php" method="post">
                                <input type="hidden" name="usuario" value="<?php echo $array_usuarios[$id]["email"]; ?>">
                                <button type="submit"  class="btn btn-sm btn-danger">Borrar</button>
                            </form>
                        </tr>
                        <?php
		                }
	                }
	                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</article>

<?php
} ?>


<!---------------------CONTENIDO VENDEDOR----------->

<?php if($_SESSION["tipo"] == "VENDEDOR")
{ ?>

<article class="col-12">
    <div class="card">
        <div class="card-header">
            <h1 class="text-secondary card-title">Productos</h1>
        </div>
        <div class="card-body">
            <a href="index.php?seccion=nuevo_producto" class="btn btn-sm btn-success float-right my-2">Agregar Producto</a>
            <div class="table-responsive">
                <table class="table table-bordered table-sm fs-90">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Código</th>
                            <th>Cantidad</th>
                            <th>Imágen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php
                    $array_productos = [];
                    $nombre = $_SESSION["nombre"];
                    $previa = mysqli_query($con, "SELECT id FROM usuarios u WHERE u.nombre='$nombre'");
                    $id_vende = mysqli_fetch_assoc($previa);
	                $resultado = mysqli_query($con, "SELECT * FROM productos WHERE id_vendedor='$id_vende[id]' ORDER BY id ASC");
                    while($fila = mysqli_fetch_array($resultado))
                    {
                        $array_productos[] = $fila;
                    }
	                if (!empty($array_productos)) 
                    { 
		                foreach($array_productos as $codigo=>$valor)
                        {
	                ?>
                        <tr>
                            <td class="py-3"><h2><?php echo $array_productos[$codigo]["nombre"]; ?></h2></td>
                            <td class="py-3"><p><?php echo $array_productos[$codigo]["precio"]; ?></p></td>
                            <td class="py-3"><p><?php echo $array_productos[$codigo]["codigo"]; ?></p></td>
                            <td class="py-3"><p><?php echo $array_productos[$codigo]["cantidad"]; ?></p></td>
                            <td class="py-3"><img width="200" src="../<?php echo $array_productos[$codigo]["imagen"]; ?>"></td>
                            <td class="py-3">
                            <div class="separador2">
                                <a class="btn btn-sm btn-primary" href="editar_producto.php?producto=<?php echo $array_productos[$codigo]["codigo"]; ?>">Editar</a>
                            </div>
                            <form action="logica/borrar_producto_logica.php" method="post">
                                <input type="hidden" name="producto" value="<?php echo $array_productos[$codigo]["codigo"]; ?>">
                                <button type="submit"  class="btn btn-sm btn-danger">Borrar</button>
                            </form>
                        </tr>
                        <?php
		                }
	                }
	                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</article>

<?php
} ?>


<!---------------------CONTENIDO CLIENTE--------------------->

<?php if($_SESSION["tipo"] == "CLIENTE")
{ ?>

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
</body>
</html>