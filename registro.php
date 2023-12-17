<body class="d-flex flex-column min-vh-100">
    <div class="container-sm p-5 my-5 bg-white text-black" style="border:3px black">
        <div class="register_card">
            <div class="form_container">
                <form action="logica/registroLogica.php" method="POST">
                    <div class="form-row">
                        <div class="input-group mb-3 col-12">
                            <h1>Registrarse</h1>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-6">
                            <input type="text" name="nombre" class="form-control input_user" placeholder="Nombre">
                        </div>
                        <div class="input-group mb-3 col-6">
                            <input type="text" name="apellido" class="form-control input_pass" placeholder="Apellido">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-12">
                            <input type="email" name="email" class="form-control input_user" placeholder="Email">
                        </div>
                    </div>
                    <div class="input-group mb-3 col-6">
                            <input type="text" name="telefono" class="form-control input_user" placeholder="Teléfono">
                        </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-6">
                            <input type="text" name="usuario" class="form-control input_user" placeholder="Usuario">
                        </div>
                        <div class="input-group mb-3 col-6">
                            <input type="password" name="contrasena" class="form-control input_pass" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <p>Tipo de usuario:</p>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="flexRadioTipo" value="CLIENTE" id="flexRadioTipo1" class="form-check-input" <?php if (isset($_POST['radio']) && $_POST['radio'] == 'cliente'): ?>checked='checked'<?php endif; ?> /> Cliente
                        </div>
                        <div class="form-check">
                            <input type="radio" name="flexRadioTipo" value="VENDEDOR" id="flexRadioTipo2" class="form-check-input" <?php if (isset($_POST['radio']) && $_POST['radio'] == 'vendedor'): ?>checked='checked'<?php endif; ?> /> Vendedor
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit">Registrarse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>