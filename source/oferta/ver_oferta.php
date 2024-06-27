<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();
$id_oferta = $_GET['id'];
$id_usuario = $_SESSION['SESION_ID'] ?? 0; // Asegúrate de que el ID del usuario esté en la sesión

if ($id_usuario == 0) {
    // Redirigir al login si no hay sesión activa
    echo "<script>alert('Por favor, inicie sesión primero.'); window.location.href='form_login.php';</script>";
    exit;
}

// Mostrar mensajes basados en parámetros de URL
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'cancel_success':
            echo "<div class='alert alert-success'>Postulación cancelada con éxito.</div>";
            break;
        case 'cancel_error':
            echo "<div class='alert alert-danger'>Error al cancelar la postulación.</div>";
            break;
    }
}

// Comprobar si el usuario ya ha postulado a la oferta
$stmt = $conexion->prepare("SELECT * FROM postulaciones WHERE id_usuario = ? AND id_oferta = ?");
$stmt->bind_param("ii", $id_usuario, $id_oferta);
$stmt->execute();
$postulacion = $stmt->get_result()->fetch_assoc();

// Contar el número de postulantes actuales para la oferta
$stmt = $conexion->prepare("SELECT COUNT(*) as total_postulantes FROM postulaciones WHERE id_oferta = ?");
$stmt->bind_param("i", $id_oferta);
$stmt->execute();
$resultado_postulantes = $stmt->get_result()->fetch_assoc();
$total_postulantes = $resultado_postulantes['total_postulantes'];

$sql = "SELECT o.*, e.razon_social FROM oferta_laboral o INNER JOIN empresas e ON o.id_empresa = e.id WHERE o.id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_oferta);
$stmt->execute();
$resultado = $stmt->get_result();
$oferta = $resultado->fetch_assoc();

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Detalle de la Oferta Laboral
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($oferta['titulo']); ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($oferta['razon_social']); ?></h6>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($oferta['descripcion'])); ?></p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Fecha de Publicación:</strong> <?php echo htmlspecialchars($oferta['fecha_publicacion']); ?></li>
                <li class="list-group-item"><strong>Fecha de Cierre:</strong> <?php echo htmlspecialchars($oferta['fecha_cierre']); ?></li>
                <li class="list-group-item"><strong>Remuneración:</strong> <?php echo htmlspecialchars($oferta['remuneracion']); ?></li>
                <li class="list-group-item"><strong>Ubicación:</strong> <?php echo htmlspecialchars($oferta['ubicacion']); ?></li>
                <li class="list-group-item"><strong>Tipo:</strong> <?php echo htmlspecialchars($oferta['tipo']); ?></li>
                <li class="list-group-item"><strong>Límite de Postulantes:</strong> <?php echo htmlspecialchars($oferta['limite_postulante']); ?></li>
                <li class="list-group-item"><strong>Postulantes Actuales:</strong> <?php echo htmlspecialchars($total_postulantes); ?></li>
            </ul>
            <?php if ($postulacion) { ?>
                <a href="cancelar_postulacion.php?id=<?php echo $oferta['id']; ?>" class="btn btn-danger mt-3">Cancelar Postulación</a>
            <?php } elseif ($fecha_actual > $oferta['fecha_cierre']) { ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Esta oferta laboral ha caducado y ya no es posible postularse.
                </div>
            <?php } elseif ($total_postulantes >= $oferta['limite_postulante']) { ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Esta oferta laboral ha alcanzado el límite de postulantes y ya no es posible postularse.
                </div>
            <?php } else { ?>
                <a href="postular_oferta.php?id=<?php echo $oferta['id']; ?>" class="btn btn-success mt-3">Postular a esta Oferta</a>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include("../../includes/foot.php");
?>
