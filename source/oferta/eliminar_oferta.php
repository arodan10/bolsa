<?php
include("../../includes/conectar.php");
$conexion = conectar();

$id = $_GET['id'];

$sql = "DELETE FROM oferta_laboral WHERE id='$id'";

mysqli_query($conexion, $sql) or die("Error al eliminar la oferta laboral.");

header("Location: listar_ofertas.php");
?>
