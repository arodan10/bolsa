<?php
include("../../includes/head.php");
include("../../includes/conectar.php");
$conexion = conectar();

$id_oferta = $_GET['id_oferta'];

$sql = "SELECT u.id, u.nombres, u.apellidos, p.fecha_hora_postulante, p.estado_actual 
        FROM postulaciones p 
        JOIN usuarios u ON p.id_usuario = u.id 
        WHERE p.id_oferta = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_oferta);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<div class="container mt-5">
    <h2 class="mb-4">Postulantes para la Oferta</h2>
    <a href="listar_ofertas_empresa.php" class="btn btn-info mb-3"><i class="fas fa-arrow-left"></i> Regresar a Ofertas</a>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Postulación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($postulante = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($postulante['nombres']); ?></td>
                    <td><?php echo htmlspecialchars($postulante['apellidos']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($postulante['fecha_hora_postulante'])); ?></td>
                    <td>
                        <span class="badge badge-<?php echo ($postulante['estado_actual'] === 'aceptado' ? 'success' : ($postulante['estado_actual'] === 'pendiente' ? 'warning' : 'danger')); ?>">
                            <?php echo htmlspecialchars($postulante['estado_actual']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="ver_perfil_postulante.php?id_usuario=<?php echo $postulante['id']; ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> Ver Perfil
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../../includes/foot.php"); ?>
