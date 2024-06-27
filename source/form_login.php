<?php
include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="my-3">Bienvenido a la Bolsa Laboral</h1>
            <p>Encuentra la oportunidad laboral perfecta o el mejor candidato para tu empresa.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Tarjeta para el formulario de login -->
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="txt_usuario">Usuario:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="txt_usuario" type="text" id="txt_usuario" class="form-control" placeholder="Ingrese su nombre de usuario" required>
                            </div>
                            <small class="form-text text-muted">Por favor, ingrese su nombre de usuario.</small>
                        </div>

                        <div class="form-group">
                            <label for="txt_password">Contraseña:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="txt_password" type="password" id="txt_password" class="form-control" placeholder="Ingrese su contraseña" required>
                            </div>
                            <small class="form-text text-muted">Asegúrese de que su contraseña sea segura.</small>
                        </div>

                        <?php if (isset($_REQUEST['error_login'])): ?>
                            <div class="form-group">
                                <div class="alert alert-danger" role="alert">
                                    Datos de usuario y contraseña incorrectos.
                                </div>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="usuario/registro_usuarios.php" class="btn btn-link">¿No tienes una cuenta? Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la zona central del sistema -->
</div>
<!-- /.container-fluid -->

<?php
include("../includes/foot.php");
?>
