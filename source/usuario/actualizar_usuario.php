<?php
include("../../includes/conectar.php");
$conexion = conectar();

$id = $_POST['id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];

// Consulta para obtener la ruta actual del CV
$query = "SELECT ruta_cv FROM usuarios WHERE id = '$id'";
$result = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($result);
$oldCvPath = $row['ruta_cv'];

// Manejo de la carga del archivo CV
if (isset($_FILES['ruta_cv']) && $_FILES['ruta_cv']['error'] == 0) {
    $fileTmpPath = $_FILES['ruta_cv']['tmp_name'];
    $fileName = $_FILES['ruta_cv']['name'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $uploadFileDir = '../cvs/';
    $dest_path = $uploadFileDir . $newFileName;

    if ($fileExtension == 'pdf') {
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            if (!empty($oldCvPath) && file_exists($oldCvPath)) {
                unlink($oldCvPath); // Eliminar el archivo CV antiguo
            }
            $ruta_cv = $dest_path;
        } else {
            die('Error al mover el archivo.');
        }
    } else {
        die('Error: Solo se permiten archivos PDF.');
    }
} else {
    $ruta_cv = $oldCvPath; // Mantener la ruta antigua si no se carga un nuevo archivo
}

$sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', dni='$dni', direccion='$direccion', telefono='$telefono', usuario='$usuario', ruta_cv='$ruta_cv' WHERE id='$id'";

if (mysqli_query($conexion, $sql)) {
    header("Location: listar_usuarios.php");
} else {
    die("Error al actualizar en la base de datos: " . mysqli_error($conexion));
}
?>
