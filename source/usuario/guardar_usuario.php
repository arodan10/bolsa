<?php

include("../../includes/conectar.php");
$conexion = conectar();

// Recepción de datos del formulario
$nombres = $_POST['txt_nombres'];
$apellidos = $_POST['txt_apellidos'];
$dni = $_POST['txt_dni'];
$direccion = $_POST['txt_direccion'];
$telefono = $_POST['txt_telefono'];
$usuario = $_POST['txt_usuario'];
$contrasenia = $_POST['txt_contrasenia'];

// Manejo de la carga del archivo CV
if (isset($_FILES['ruta_cv']) && $_FILES['ruta_cv']['error'] == 0) {
    $fileTmpPath = $_FILES['ruta_cv']['tmp_name'];
    $fileName = $_FILES['ruta_cv']['name'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Sanitización del nombre del archivo y asegurarse de que es PDF
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    if ($fileExtension == 'pdf') {
        $uploadFileDir = '../cvs/';
        $dest_path = $uploadFileDir . $newFileName;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $ruta_cv = $dest_path;
        } else {
            die('Error al mover el archivo.');
        }
    } else {
        die('Error: Solo se permiten archivos PDF.');
    }
} else {
    die('Error: Ha ocurrido un error con el archivo.');
}

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombres, apellidos, dni, direccion, telefono, usuario, contrasenia, id_rol, ruta_cv) VALUES ('$nombres', '$apellidos', '$dni', '$direccion', '$telefono', '$usuario', '$contrasenia', 0, '$ruta_cv')";
if (mysqli_query($conexion, $sql)) {
    header("Location: listar_usuarios.php");
} else {
    die("Error al guardar en la base de datos: " . mysqli_error($conexion));
}


?>