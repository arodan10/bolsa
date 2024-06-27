<?php
include("../../includes/head.php");
include("../../includes/conectar.php");


$conexion = conectar();
$id_usuario = $_GET['id_usuario'] ?? 0; // Obtener el ID del usuario desde la URL



// Consulta para obtener la información del usuario/postulante
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();



// Obtener las postulaciones del usuario
$sql_postulacion = "SELECT * FROM postulaciones WHERE id_usuario = ?";
$stmt_postulacion = $conexion->prepare($sql_postulacion);
$stmt_postulacion->bind_param("i", $id_usuario);
$stmt_postulacion->execute();
$postulacion = $stmt_postulacion->get_result()->fetch_assoc();

// Obtener mensaje de estado de la sesión
$estado_postulacion = $_SESSION['estado_postulacion'] ?? '';
unset($_SESSION['estado_postulacion']); // Limpiar el mensaje después de mostrarlo

?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Perfil de Postulante</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Información del Postulante
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($usuario['nombres']) . ' ' . htmlspecialchars($usuario['apellidos']); ?></h5>
                    <p class="card-text"><strong>DNI:</strong> <?php echo htmlspecialchars($usuario['dni']); ?></p>
                    <p class="card-text"><strong>Dirección:</strong> <?php echo htmlspecialchars($usuario['direccion']); ?></p>
                    <p class="card-text"><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['telefono']); ?></p>
                    <p class="card-text"><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['usuario']); ?></p>
                    <?php if ($usuario['ruta_foto']) : ?>
                        <img src="<?php echo htmlspecialchars($usuario['ruta_foto']); ?>" alt="Foto de Perfil" class="img-fluid rounded-circle mt-3">
                    <?php else : ?>
                        <p>No hay foto de perfil cargada.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-3">
                <a href="javascript:history.go(-1)" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    CV del Postulante
                </div>
                <div class="card-body">
                    <?php if ($usuario['ruta_cv']) : ?>
                        <iframe src="<?php echo htmlspecialchars($usuario['ruta_cv']); ?>" style="width:100%; height:500px;" frameborder="0"></iframe>
                    <?php else : ?>
                        <p>No hay CV cargado.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($postulacion) : ?>
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    Estado de la Postulación
                </div>
                <div class="card-body">
                    <?php if ($estado_postulacion == 'success') : ?>
                        <div class="alert alert-success" role="alert">
                            Estado de la postulación actualizado correctamente.
                        </div>
                    <?php elseif ($estado_postulacion == 'error') : ?>
                        <div class="alert alert-danger" role="alert">
                            Error al actualizar el estado de la postulación.
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="actualizar_estado_postulacion.php">
                        <input type="hidden" name="id_postulacion" value="<?php echo $postulacion['id']; ?>">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <div class="form-group">
                            <label for="estado_actual">Estado Actual:</label>
                            <select class="form-control" id="estado_actual" name="estado_actual">
                                <option value="pendiente" <?php echo ($postulacion['estado_actual'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="aceptado" <?php echo ($postulacion['estado_actual'] == 'aceptado') ? 'selected' : ''; ?>>Aceptado</option>
                                <option value="rechazado" <?php echo ($postulacion['estado_actual'] == 'rechazado') ? 'selected' : ''; ?>>Rechazado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Actualizar Estado</button>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("../../includes/foot.php"); ?>
