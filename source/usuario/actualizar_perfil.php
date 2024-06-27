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

// Consulta para obtener las rutas actuales del CV y la foto
$query = "SELECT ruta_cv, ruta_foto FROM usuarios WHERE id = '$id'";
$result = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($result);
$oldCvPath = $row['ruta_cv'];
$oldFotoPath = $row['ruta_foto'];

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

// Manejo de la carga del archivo de la foto de perfil
if (isset($_FILES['ruta_foto']) && $_FILES['ruta_foto']['error'] == 0) {
    $fileTmpPath = $_FILES['ruta_foto']['tmp_name'];
    $fileName = $_FILES['ruta_foto']['name'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $uploadFileDir = '../fotos/';
    $dest_path = $uploadFileDir . $newFileName;

    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            if (!empty($oldFotoPath) && file_exists($oldFotoPath)) {
                unlink($oldFotoPath); // Eliminar la foto de perfil antigua
            }
            $ruta_foto = $dest_path;
        } else {
            die('Error al mover el archivo.');
        }
    } else {
        die('Error: Solo se permiten archivos JPG, GIF, PNG y JPEG.');
    }
} else {
    $ruta_foto = $oldFotoPath; // Mantener la ruta antigua si no se carga una nueva foto
}

$sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', dni='$dni', direccion='$direccion', telefono='$telefono', usuario='$usuario', ruta_cv='$ruta_cv', ruta_foto='$ruta_foto' WHERE id='$id'";

if (mysqli_query($conexion, $sql)) {
    header("Location: perfil.php");
} else {
    die("Error al actualizar en la base de datos: " . mysqli_error($conexion));
}
?>
