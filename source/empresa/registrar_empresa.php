<?php include("../../includes/head.php"); ?>

<!-- Begin Page Content -->
<div class="container">
    <!-- Inicio de la zona central del sistema -->
    <div class="py-5 text-center">
        <h2 class="display-4">Registro de Nuevas Empresas</h2>
        <p class="lead">Completa los campos para registrar una nueva empresa en el sistema.</p>
    </div>

    <div class="row">
        <div class="col-md-8 order-md-1 mx-auto">
            <form method="POST" action="guardar_empresa.php" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="razon_social">Razón Social:</label>
                    <input type="text" class="form-control" id="razon_social" name="razon_social" required placeholder="Ingrese la razón social">
                    <div class="invalid-feedback">Por favor, ingrese la razón social de la empresa.</div>
                </div>

                <div class="mb-3">
                    <label for="ruc">RUC:</label>
                    <input type="text" class="form-control" id="ruc" name="ruc" required placeholder="Ingrese el RUC">
                    <div class="invalid-feedback">Por favor, ingrese el RUC de la empresa.</div>
                </div>

                <div class="mb-3">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required placeholder="Ingrese la dirección completa">
                    <div class="invalid-feedback">Por favor, ingrese la dirección de la empresa.</div>
                </div>

                <div class="mb-3">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required placeholder="Ingrese el teléfono de contacto">
                    <div class="invalid-feedback">Por favor, ingrese un teléfono válido.</div>
                </div>

                <div class="mb-3">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" required placeholder="ejemplo@empresa.com">
                    <div class="invalid-feedback">Por favor, ingrese un correo electrónico válido.</div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">Registrar Empresa</button>
            </form>
        </div>
    </div>
    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid -->

<?php include("../../includes/foot.php"); ?>

<script>
// Ejemplo de validación de formulario de Bootstrap
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
