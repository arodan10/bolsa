<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

// Obtener el ID del usuario de la sesión
$id_usuario = $_SESSION['SESION_ID'];
$sql = "SELECT * FROM usuarios WHERE id='$id_usuario'";
$registro = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_array($registro);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row justify-content-center">
    <!-- Inicio de la zona central del sistema -->
    
    <div class="col-md-8">
        <h1 class="text-center mb-4">Mi Perfil</h1>
      <div class="card shadow-lg">
        <div class="card-body">
          <form method="POST" action="actualizar_perfil.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

            <div class="row mb-3">
              <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombres" value="<?php echo htmlspecialchars($fila['nombres']); ?>" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="apellidos" value="<?php echo htmlspecialchars($fila['apellidos']); ?>" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="dni" class="col-sm-2 col-form-label">DNI</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="dni" value="<?php echo htmlspecialchars($fila['dni']); ?>" pattern="\d{8}" title="Ingresa un DNI válido de 8 dígitos" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="direccion" value="<?php echo htmlspecialchars($fila['direccion']); ?>" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($fila['telefono']); ?>" pattern="\d{9}" title="Ingresa un número de teléfono válido de 9 dígitos" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="usuario" value="<?php echo htmlspecialchars($fila['usuario']); ?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="ruta_foto" class="col-sm-2 col-form-label">Foto de Perfil</label>
              <div class="col-sm-10">
                <?php if ($fila['ruta_foto']) : ?>
                  <img src="<?php echo htmlspecialchars($fila['ruta_foto']); ?>" alt="Foto de Perfil" style="width: 100px; height: 100px;">
                <?php else : ?>
                  <p>No hay foto de perfil cargada.</p>
                <?php endif; ?>
                
              </div>
            </div>

            <div class="row mb-3">
              <label for="ruta_cv" class="col-sm-2 col-form-label">Cargar Nueva Foto</label>
              <div class="col-sm-10">
              <input type="file" class="form-control-file" id="ruta_foto" name="ruta_foto" accept="image/*">
                <img id="foto_preview" style="width: 100px; height: 100px;" hidden>
                <small>Si carga una nueva foto, el anterior será reemplazado.</small>
              </div>
            </div>

            <div class="row mb-3">
              <label for="ruta_cv" class="col-sm-2 col-form-label">CV Actual (PDF)</label>
              <div class="col-sm-10">
                <?php if ($fila['ruta_cv']) : ?>
                  <iframe src="<?php echo htmlspecialchars($fila['ruta_cv']); ?>" style="width:100%; height:300px;"></iframe>
                <?php else : ?>
                  <p>No hay CV cargado.</p>
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-3">
              <label for="ruta_cv" class="col-sm-2 col-form-label">Cargar Nuevo CV (PDF)</label>
              <div class="col-sm-10">
                <input type="file" class="form-control-file" id="new_ruta_cv" name="ruta_cv" accept=".pdf">
                <iframe id="pdf_preview" style="width:100%; height:300px;" hidden></iframe>
                <small>Si carga un nuevo CV, el anterior será reemplazado.</small>
              </div>
            </div>

            <button type="submit" class="btn btn-success btn-lg mt-3">
              <i class="fas fa-sync-alt"></i> Actualizar Usuario
            </button>
          </form>
        </div>
      </div>
    </div>
    <!-- Fin  de la zona central del sistema -->
  </div>
</div>
<!-- /.container-fluid -->

<?php
include("../../includes/foot.php");
?>

<script>
  document.getElementById('new_ruta_cv').addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file && file.type === "application/pdf") {
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

  document.getElementById('ruta_foto').addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
      var fileReader = new FileReader();
      fileReader.onload = function() {
        var imgData = fileReader.result;
        var imgPreview = document.getElementById('foto_preview');
        imgPreview.src = imgData;
        imgPreview.hidden = false; // Mostrar la imagen
      };
      fileReader.readAsDataURL(file);
    } else {
      alert('Por favor, seleccione un archivo de imagen.');
      document.getElementById('foto_preview').hidden = true; // Ocultar la imagen si el archivo no es una imagen
    }
  });
</script>