<?php
include("../../includes/conectar.php");
$conexion = conectar();

session_start(); // Iniciar sesión para manejar mensajes de estado

$id_postulacion = $_POST['id_postulacion'];
$estado_actual = $_POST['estado_actual'];
$id_usuario = $_POST['id_usuario'];

// Actualizar el estado de la postulación en la base de datos
$sql = "UPDATE postulaciones SET estado_actual = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("si", $estado_actual, $id_postulacion);

if ($stmt->execute()) {
    $_SESSION['estado_postulacion'] = 'success';
} else {
    $_SESSION['estado_postulacion'] = 'error';
}

header("Location: ver_perfil_postulante.php?id_usuario=" . $id_usuario);exit;
?>
