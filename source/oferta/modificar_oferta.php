<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

$id = $_REQUEST['id'];
$sql = "SELECT * FROM oferta_laboral WHERE id='$id'";
$registro = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_array($registro);
?>

<div class="container-fluid">
    <h1>Modificar Oferta Laboral</h1>

    <form method="POST" action="actualizar_oferta.php">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
        <div class="row mb-3">
            <div class="col-sm-10">
                <input type="hidden" class="form-control" name="id_empresa" value="<?php echo $_SESSION["SESION_ID_EMPRESA"]; ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="titulo" class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" value="<?php echo $fila['titulo']; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="descripcion"><?php echo $fila['descripcion']; ?></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fecha_publicacion" class="col-sm-2 col-form-label">Fecha de Publicación</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="fecha_publicacion" value="<?php echo $fila['fecha_publicacion']; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fecha_cierre" class="col-sm-2 col-form-label">Fecha de Cierre</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="fecha_cierre" value="<?php echo $fila['fecha_cierre']; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="remuneracion" class="col-sm-2 col-form-label">Remuneración</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="remuneracion" value="<?php echo $fila['remuneracion']; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="ubicacion" class="col-sm-2 col-form-label">Ubicación</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ubicacion" value="<?php echo $fila['ubicacion']; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
            <div class="col-sm-10">
                <select class="form-control" name="tipo">
                    <option value="presencial" <?php if($fila['tipo'] == 'presencial') echo 'selected'; ?>>Presencial</option>
                    <option value="remoto" <?php if($fila['tipo'] == 'remoto') echo 'selected'; ?>>Remoto</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="limite_postulante" class="col-sm-2 col-form-label">Límite de Postulantes</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="limite_postulante" value="<?php echo $fila['limite_postulante']; ?>">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Oferta Laboral</button>
    </form>
</div>

<?php
include("../../includes/foot.php");
?>
