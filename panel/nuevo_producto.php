
<!------------------------BODY------------------------------>
<body class="d-flex flex-column min-vh-100">
<!-------------------FORMULARIO------------------->
<?php
    if($_SESSION["tipo"] == "VENDEDOR"){ ?>
    
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="justificado">Nuevo Producto</h1>
        </div>
    </div>
</div>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-6 col-xl-4 mx-5 mt-1 mb-3">
            <div class="card">
                <div class="card-body">
                    <form action="logica/nuevo_producto_logica.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="producto">  
                        <div class="form-group">
                            <label class="justificado" for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Producto">
                        </div>
                        <div class="form-group">
                            <label class="justificado" for="precio">Precio</label>
                            <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio del Producto">
                        </div>
                        <div class="form-group">
                            <label class="justificado" for="codigo">Código</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código del Producto">
                        </div>
                        <div class="form-group">
                            <label class="justificado" for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad en Stock">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                  <label for="imagen"></label>
                                  <input type="file" class="form-control-file" name="imagen" id="imagen" aria-describedby="fileHelpId">
                            </div>   
                            <button type="submit" class="btn btn-secondary btn-block">Agregar Producto</button>
                        </div>
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
</body>