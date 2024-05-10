<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row justify-content-center">
    <!-- Inicio de la zona central del sistema -->
    <h1>Modificar datos de Usuario</h1>

    <?php
    //recibimos el id a modificar
    $pid = $_REQUEST['id'];

    $sql = "SELECT * FROM usuarios WHERE id='$pid'";
    $registro = mysqli_query($conexion, $sql);

    //en la variable $fila tenemos todos los datos del
    //registro que se desea modificar
    $fila = mysqli_fetch_array($registro);
    //echo print_r($fila);
    ?>
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="card-body">
          <form method="POST" action="actualizar_usuario.php" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $fila['id'] ?>">

            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Nombres</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nombres" value="<?php echo $fila['nombres'] ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Apellidos</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="apellidos" value="<?php echo $fila['apellidos'] ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="dni" value="<?php echo $fila['dni'] ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Direccion</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="direccion" value="<?php echo $fila['direccion'] ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Teléfono</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telefono" value="<?php echo $fila['telefono'] ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Usuario</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="usuario" value="<?php echo $fila['usuario'] ?>">
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
</script>