<body class="d-flex flex-column min-vh-100">
    <div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black">
        <form action="logica/loginlogica.php" method="POST">
            <div class="row">
                <div class="col-4">
                    <h1>Iniciar Sesión</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h3>Usuario</h3>
                </div>
                <div class="input-group mb-3 col-6">
                    <input type="usuario" name="usuario" class="form-control input_user" placeholder="Nombre de Usuario" required>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h3>Contraseña</h3>
                </div>
                <div class="input-group mb-3 col-6">
                    <input type="password" name="contrasena" class="form-control input_pass" placeholder="Contraseña" required>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <button type="submit">Ingresar</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>