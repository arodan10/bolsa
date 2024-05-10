<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();
$id_usuario = $_SESSION['SESION_ID'] ?? 0; // Asegúrate que el ID del usuario está en la sesión

if ($id_usuario == 0) {
    // Redirigir al login si no hay sesión activa
    echo "<script>alert('Por favor, inicie sesión primero.'); window.location.href='form_login.php';</script>";
    exit;
}

// Consulta para obtener las postulaciones del usuario
$sql = "SELECT o.titulo, o.fecha_cierre, p.estado_actual, p.fecha_hora_postulante, o.id as oferta_id
        FROM postulaciones p
        JOIN oferta_laboral o ON p.id_oferta = o.id
        WHERE p.id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<div class="container mt-5">
    <h2>Mis Postulaciones</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Oferta</th>
                <th>Fecha de Postulación</th>
                <th>Fecha de Cierre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['titulo']); ?></td>
                    <td><?php echo htmlspecialchars(date("d-m-Y H:i:s", strtotime($fila['fecha_hora_postulante']))); ?></td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($fila['fecha_cierre']))); ?></td>
                    <td><?php echo htmlspecialchars($fila['estado_actual']); ?></td>
                    <td>
                        <a href="ver_oferta.php?id=<?php echo $fila['oferta_id']; ?>" class="btn btn-info">Ver Oferta</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../../includes/foot.php"); ?>
