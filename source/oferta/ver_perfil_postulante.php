<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();
$id_usuario = $_GET['id_usuario'] ?? 0; // Obtener el ID del usuario desde la URL

if ($id_usuario == 0) {
    // Redirigir o manejar el error si el ID no es válido o no se proporciona
    echo "<script>alert('No se proporcionó un ID de usuario válido.'); window.location.href='index.php';</script>";
    exit;
}

// Consulta para obtener la información del usuario/postulante
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    echo "<script>alert('El usuario no existe.'); window.location.href='index.php';</script>";
    exit;
}

?>
<div class="container mt-5">
    <h2>Perfil de Postulante</h2>
    <div class="card">
        <div class="card-header">
            Información del Postulante
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($usuario['nombres']) . ' ' . htmlspecialchars($usuario['apellidos']); ?></h5>
            <p class="card-text">DNI: <?php echo htmlspecialchars($usuario['dni']); ?></p>
            <p class="card-text">Dirección: <?php echo htmlspecialchars($usuario['direccion']); ?></p>
            <p class="card-text">Teléfono: <?php echo htmlspecialchars($usuario['telefono']); ?></p>
            <p class="card-text">Correo: <?php echo htmlspecialchars($usuario['usuario']); ?></p>
            <!-- Aquí puedes agregar más detalles según lo necesites -->
        </div>
    </div>
</div>

<?php include("../../includes/foot.php"); ?>
