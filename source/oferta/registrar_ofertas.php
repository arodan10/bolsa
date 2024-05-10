<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

// Consultar el nombre de la empresa usando el ID almacenado en la sesión
if (isset($_SESSION["SESION_ID_EMPRESA"])) {
    $stmt = $conexion->prepare("SELECT razon_social FROM empresas WHERE id = ?");
    $stmt->bind_param("i", $_SESSION["SESION_ID_EMPRESA"]);
    $stmt->execute();
    $resultado_empresa = $stmt->get_result();
    $empresa = $resultado_empresa->fetch_assoc();
}
?>

<div class="container d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card border-left-primary shadow py-2 mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registro de Oferta Laboral - Empresa: <?php echo htmlspecialchars($empresa['razon_social']); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <form method="POST" action="guardar_oferta.php">
                    <!-- Campos ocultos para mantener el ID de la empresa -->
                    <input type="hidden" name="id_empresa" value="<?php echo $_SESSION["SESION_ID_EMPRESA"]; ?>">

                    <!-- Formulario de registro de oferta -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo" required>
                                <option value="presencial">Presencial</option>
                                <option value="remoto">Remoto</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="4" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_publicacion">Fecha de Publicación</label>
                            <input type="date" class="form-control" name="fecha_publicacion" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_cierre">Fecha de Cierre</label>
                            <input type="date" class="form-control" name="fecha_cierre" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="remuneracion">Remuneración</label>
                            <input type="text" class="form-control" name="remuneracion">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" class="form-control" name="ubicacion" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="limite_postulante">Límite de Postulantes</label>
                            <input type="number" class="form-control" name="limite_postulante">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Oferta Laboral</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php
include("../../includes/foot.php");
?>