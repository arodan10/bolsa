<?php
include "../../includes/conectar.php";

$conexion = conectar();

$id = $_POST['id'];
$id_empresa = $_POST['id_empresa'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_publicacion = $_POST['fecha_publicacion'];
$fecha_cierre = $_POST['fecha_cierre'];
$remuneracion = $_POST['remuneracion'];
$ubicacion = $_POST['ubicacion'];
$tipo = $_POST['tipo'];
$limite_postulante = $_POST['limite_postulante'];

$sql = "UPDATE oferta_laboral SET id_empresa='$id_empresa', titulo='$titulo', descripcion='$descripcion', fecha_publicacion='$fecha_publicacion', fecha_cierre='$fecha_cierre', remuneracion='$remuneracion', ubicacion='$ubicacion', tipo='$tipo', limite_postulante='$limite_postulante' WHERE id='$id'";

mysqli_query($conexion, $sql) or die("Error al actualizar la oferta laboral.");

header("Location: listar_ofertas.php");
?>
