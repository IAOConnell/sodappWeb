<body class="d-flex flex-column min-vh-100">
    <!------------------PERFIL------------------------->
    <div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black">
        <div class="row">
            <div class="col-4">
                <img src="<?php echo $_SESSION["imagen"] ?>" style="width: 256px ; height: 256 px">
            </div>
            <div class="col-4">
                <dl>
                    <dt>Usuario:</dt>
                    <dd><?php echo $_SESSION["usuario"] ?> </dd>
                    <dt>Nombre:</dt>
                    <dd><?php echo $_SESSION["nombre"] ?> <?php echo $_SESSION["apellido"]?></dd>
                    <dt>Correo:</dt>
                    <dd><?php echo $_SESSION["email"] ?> </dd>
                    <dt>Teléfono:</dt>
                    <dd><?php echo $_SESSION["telefono"] ?> </dd>
                    <dt>Dirección:</dt>
                    <dd><?php echo $_SESSION["direccion"] ?> </dd>
                </dl>
                <form action="logica/cambioimagen.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="imagen"></label>
                        <input type="file" class="form-control-file" name="imagen" id="imagen" aria-describedby="fileHelpId">
                    </div>
                    <?php
                        if(isset($imagen)):
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <img src="<?= $imagen; ?>" alt="<?= $nombre; ?>" class="img-fluid">
                        </div>
                        <?php
                            endif;
                        ?>
                    </div>
                <button type="submit" class="btn btn-secondary btn-block">Cambiar imágen</button>
                </form>
            </div>
        </div>
    </div>

    <!-------------AGENDA----------------------->
    <?php $array_agenda = [];
    if($_SESSION["tipo"] == "VENDEDOR")
    {
        $usuario_agenda = $_SESSION["usuario"];
        $select_id_vendedor = "SELECT id FROM usuarios WHERE usuario LIKE '%$usuario_agenda%' ";
        $sql_idv= mysqli_query($con, $select_id_vendedor);
        $idv = mysqli_fetch_array($sql_idv);
        $id_vendedor=  $idv['id'];



        $select= "SELECT * FROM compras_agenda WHERE id_compra IN (SELECT id FROM compras WHERE id_vendedor = '$id_vendedor') ORDER BY d_id ASC";
        $agenda_resultados= mysqli_query($con, $select);
        ?>


    <div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black">
        <div class="row">
            <div class="col-12">
                <h3>Agenda de entregas semanales:</h3>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="table-primary">
                    <th>Día</th>
                    <th>Horario</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Detalles</th>
                </thead>
        <?php
        while($fila = mysqli_fetch_array($agenda_resultados))
        {
            $array_agenda[] = $fila;
        }
        if (!empty($array_agenda)) 
        { 
		    foreach($array_agenda as $idc=>$id)
            {
                $id_com = $id['id_compra'];
                $select_id_comprador= mysqli_query($con, "SELECT id_comprador FROM compras WHERE id = '$id_com' LIMIT 1");
                $com = mysqli_fetch_array($select_id_comprador);
                $id_comprador=  $com['id_comprador'];

                $select_nombre= mysqli_query($con, "SELECT usuario FROM usuarios WHERE id = '$id_comprador'");
                $nom = mysqli_fetch_array($select_nombre);
                $nombre_usuario=  $nom['usuario'];

                $select_direccion= mysqli_query($con, "SELECT direccion FROM usuarios WHERE id = '$id_comprador'");
                $dir = mysqli_fetch_array($select_direccion);
                $direccion_usuario=  $dir['direccion'];
            ?>
                <tr>
                    <td><?php echo $array_agenda[$idc]['dia'] ?></td>
                    <td><?php echo $array_agenda[$idc]['hora'] ?></td>
                    <td><?php echo $nombre_usuario ?></td>
                    <td><?php echo $direccion_usuario ?></td>
                    <td><a href="index.php?seccion=detalles&compra=<?php echo $id_com; ?>">Detalles</a></td>
                <tr>
    <?php

     }
    }
    ?>
        </table>
</div>
</div>
<?php
    } ?>


<!-------------HISTORIAL--------------------->
    <div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black">
    <div class="row">
            <div class="col-12">
                <h3>Historial de Compras:</h3>
            </div>
        </div>
        <div class="row">
        <table class="table">
    <?php 
    $array_historial = [];
    $a = 0;
    $my_user = $_SESSION["usuario"];
    if($_SESSION["tipo"] == "VENDEDOR") { 
        $select= "SELECT * FROM compras WHERE id_vendedor = (SELECT id FROM usuarios WHERE usuario LIKE '%$my_user%' LIMIT 1) ORDER BY id DESC";
        $compras_resultados= mysqli_query($con, $select);
        $a=1;
        ?>
        <thead class="table-primary">
                <th>Comprador</th>
                <th>Monto</th>
                <th>Detalles</th>
            </thead>
            <?php
        }
        else
        {
            ?>
            <thead class="table-primary">
                <th>Vendedor</th>
                <th>Monto</th>
                <th>Detalles</th>
            </thead>
            <?php
        $select= "SELECT * FROM compras WHERE id_comprador = (SELECT id FROM usuarios WHERE usuario LIKE '%$my_user%' LIMIT 1) ORDER BY id DESC";
        $compras_resultados= mysqli_query($con, $select);
        $a=2;
        }


        while($fila = mysqli_fetch_array($compras_resultados))
        {
            $array_historial[] = $fila;
        }
        if (!empty($array_historial)) 
        { 
		    foreach($array_historial as $idc=>$id)
        {
            
            if($a == 1)
            {
                $select_usuario = $array_historial[$idc]["id_comprador"];
                $select_nombre= mysqli_query($con, "SELECT usuario FROM usuarios WHERE id = $select_usuario");
                $nom = mysqli_fetch_array($select_nombre);
                $nombre_usuario=  $nom['usuario'];
            }
            if($a == 2)
            {
                $select_usuario = $array_historial[$idc]["id_vendedor"];
                $select_nombre= mysqli_query($con,"SELECT usuario FROM usuarios WHERE id = $select_usuario");
                $nom = mysqli_fetch_array($select_nombre);
                $nombre_usuario=  $nom['usuario'];
            }
        ?>
        <tr>
            <td><?php echo $nombre_usuario ?></td>
            <td><?php echo $array_historial[$idc]['monto'] ?></td>
            <td><a href="index.php?seccion=detalles&compra=<?php echo $array_historial[$idc]["id"]; ?>">Detalles</a></td>
        </tr>
        <?php 
        }
        }
        ?>
        </div>
    </table>
</body>