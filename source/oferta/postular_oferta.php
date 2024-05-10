<?php
session_start(); // Asegurar que la sesión siempre se inicia primero

include("../../includes/conectar.php");
$conexion = conectar();

if (!isset($_SESSION['SESION_ID'])) {
    // Si no hay sesión, redirigir al login
    header('Location: form_login.php');
    exit;
}

$id_oferta = $_GET['id'];
$id_usuario = $_SESSION['SESION_ID'];

// Comprobar si ya existe una postulación
$stmt = $conexion->prepare("SELECT * FROM postulaciones WHERE id_usuario = ? AND id_oferta = ?");
$stmt->bind_param("ii", $id_usuario, $id_oferta);
$stmt->execute();
$resultado_verificar = $stmt->get_result();

if ($resultado_verificar->num_rows > 0) {
    header("Location: buscar_ofertas.php?status=already_postulated");
    exit;
} else {
    $stmt_postular = $conexion->prepare("INSERT INTO postulaciones (id_usuario, id_oferta, fecha_hora_postulante, estado_actual) VALUES (?, ?, NOW(), 'pendiente')");
    $stmt_postular->bind_param("ii", $id_usuario, $id_oferta);
    $stmt_postular->execute();
    
    if ($stmt_postular->affected_rows > 0) {
        header("Location: buscar_ofertas.php?status=success");
    } else {
        header("Location: buscar_ofertas.php?status=error");
    }
    exit;
}
?>
