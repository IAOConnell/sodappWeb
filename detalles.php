<?php $compra = $_GET['compra'] ?>

<body class="d-flex flex-column min-vh-100">

    <div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black">
    <div class="row">
    <?php 
    $array_detalle = [];
    $a = 0;
    $my_user = $_SESSION["usuario"];
    if($_SESSION["tipo"] == "VENDEDOR") { 
        $select= "SELECT * FROM compras_detalle WHERE id_vendedor = (SELECT id FROM usuarios WHERE usuario LIKE '%$my_user%' LIMIT 1) ORDER BY id DESC";
        $compras_resultados= mysqli_query($con, $select);
        $a=1;
        ?>
        <div class="col-12">
                <h3>Detalles de la venta:</h3>
            </div>
        </div>
        <div class="row">
            <table class="table">
        <thead class="table-primary">
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </thead>
            <?php
        }
        else
        {
            ?>
            <div class="col-12">
                <h3>Detalles de la compra:</h3>
            </div>
        </div>
        <div class="row">
            <table class="table">
            <thead class="table-primary">
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </thead>
            <?php
        $a=2;
        }
        $select= "SELECT * FROM compras_detalle WHERE id_compra = '$compra' ORDER BY id DESC";
        $compras_resultados= mysqli_query($con, $select);


        while($fila = mysqli_fetch_array($compras_resultados))
        {
            $array_detalle[] = $fila;
        }
        if (!empty($array_detalle)) 
        { 
		    foreach($array_detalle as $idc=>$id)
        {
            
                $select_producto = $array_detalle[$idc]["id_producto"];
                $select_nombre= mysqli_query($con,"SELECT nombre FROM productos WHERE id = '$select_producto'");
                $nom = mysqli_fetch_array($select_nombre);
                $nombre_producto=  $nom['nombre'];
        ?>
        <tr>
            <td><?php echo $nombre_producto ?></td>
            <td><?php echo $array_detalle [$idc]['precio'] ?></td>
            <td><?php echo $array_detalle [$idc]['cantidad'] ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        </div>
    </table>
</body>