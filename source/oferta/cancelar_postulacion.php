<?php
ob_start(); // Inicia el almacenamiento en búfer
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

if (!isset($_SESSION['SESION_ID'])) {
    header('Location: form_login.php?error=login_required');
    exit;
}

$id_oferta = $_GET['id'];
$id_usuario = $_SESSION['SESION_ID'];

$stmt = $conexion->prepare("DELETE FROM postulaciones WHERE id_usuario = ? AND id_oferta = ?");
$stmt->bind_param("ii", $id_usuario, $id_oferta);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: ver_oferta.php?id=$id_oferta&msg=cancel_success");
} else {
    header("Location: ver_oferta.php?id=$id_oferta&msg=cancel_error");
}
include("../../includes/foot.php");
ob_end_flush(); // Envía el contenido del búfer al cliente
?>
