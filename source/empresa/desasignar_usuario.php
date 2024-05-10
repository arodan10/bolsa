<?php
include("../../includes/conectar.php");
$conexion = conectar();

$id_empresa = $_GET['id'];

// Obtener el ID del usuario actualmente asignado
$sqlConsulta = "SELECT id_usuario FROM empresas WHERE id='$id_empresa'";
$resultado = mysqli_query($conexion, $sqlConsulta);
$fila = mysqli_fetch_assoc($resultado);
$id_usuario_actual = $fila['id_usuario'];

// Paso 1: Desasignar el usuario de la empresa
$sqlDesasignar = "UPDATE empresas SET id_usuario=NULL WHERE id='$id_empresa'";
mysqli_query($conexion, $sqlDesasignar) or die("Error al desasignar el usuario: " . mysqli_error($conexion));

// Paso 2: Actualizar el estado de asignación del usuario
$sqlActualizar = "UPDATE usuarios SET asignacion=0 WHERE id='$id_usuario_actual'";
mysqli_query($conexion, $sqlActualizar) or die("Error al actualizar el estado del usuario.");

// Redirigir de vuelta a la lista de empresas
header("Location: listar_empresas.php");
?>
