<?php
include("../../includes/conectar.php");
$conexion = conectar();

$id = $_GET['id'];

// Primero obtenemos la ruta del archivo CV del usuario
$sql = "SELECT ruta_cv FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($conexion, $sql);
if ($fila = mysqli_fetch_assoc($resultado)) {
    $rutaCv = $fila['ruta_cv'];
    // Intentar eliminar el archivo PDF si existe
    if (file_exists($rutaCv)) {
        if (!unlink($rutaCv)) {
            die("Error al eliminar el archivo.");
        }
    }
    
    // Luego eliminamos el registro del usuario
    $sqlDelete = "DELETE FROM usuarios WHERE id='$id'";
    mysqli_query($conexion, $sqlDelete) or die("Error al eliminar el usuario.");

    header("Location: listar_usuarios.php");
} else {
    die("Error al obtener información del usuario.");
}
?>
