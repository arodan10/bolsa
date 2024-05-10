<?php include("../../includes/head.php"); ?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <h1 class="my-4">Registro de Nuevos Usuarios</h1>
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="card-body">
          <form method="POST" action="guardar_usuario.php" class="needs-validation" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="csrf_token" value="token_generado_servidor">

            <div class="form-group row">
              <label for="txt_nombres" class="col-sm-2 col-form-label">Nombres</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="txt_nombres" id="txt_nombres" required>
                <div class="invalid-feedback">Por favor, ingrese los nombres.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="txt_apellidos" class="col-sm-2 col-form-label">Apellidos</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" required>
                <div class="invalid-feedback">Por favor, ingrese los apellidos.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="txt_dni" class="col-sm-2 col-form-label">DNI</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="txt_dni" id="txt_dni" pattern="\d{8}" title="Ingresa un DNI válido de 8 dígitos" required>
                <div class="invalid-feedback">Por favor, ingrese un DNI válido.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="txt_direccion" class="col-sm-2 col-form-label">Dirección</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="txt_direccion" id="txt_direccion" required>
                <div class="invalid-feedback">Por favor, ingrese una dirección.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="txt_telefono" class="col-sm-2 col-form-label">Teléfono</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" pattern="\d{9}" title="Ingresa un número de teléfono válido de 9 dígitos" required>
                <div class="invalid-feedback">Por favor, ingrese un número de teléfono válido.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="txt_usuario" class="col-sm-2 col-form-label">Usuario</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="txt_usuario" id="txt_usuario" required>
                <div class="invalid-feedback">Por favor, ingrese un nombre de usuario.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="txt_contrasenia" class="col-sm-2 col-form-label">Contraseña</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="txt_contrasenia" id="txt_contrasenia" required>
                <div class="invalid-feedback">Por favor, ingrese una contraseña.</div>
              </div>
            </div>

            <div class="form-group row">
              <label for="ruta_cv" class="col-sm-2 col-form-label">Cargar CV</label>
              <div class="col-sm-10">
                <input type="file" class="form-control-file" name="ruta_cv" id="ruta_cv" accept=".pdf" required>
                <div class="mt-2">
                  <iframe id="pdf_preview" style="width:100%; height:500px;" hidden></iframe>
                </div>
              </div>
            </div>


            <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Crear Usuario</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("../../includes/foot.php"); ?>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
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

<script>
  document.getElementById('ruta_cv').addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file.type === "application/pdf") {
      var fileReader = new FileReader();
      fileReader.onload = function() {
        var pdfData = fileReader.result;
        var pdfPreview = document.getElementById('pdf_preview');
        pdfPreview.src = pdfData;
        pdfPreview.hidden = false; // Mostrar el iframe
      };
      fileReader.readAsDataURL(file);
    } else {
      alert('Por favor, seleccione un archivo PDF.');
      document.getElementById('pdf_preview').hidden = true; // Ocultar el iframe si el archivo no es PDF
    }
  });

  // Función para desactivar la validación y mejorar la interactividad
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('needs-validation');
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
