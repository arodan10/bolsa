<?php
include("../includes/conectar.php");
session_start(); // Mover session_start() arriba para asegurar que la sesión esté activa antes de usarla

$conexion = conectar();

// Recibimos los datos de usuario y contraseña
$usuario = $_POST['txt_usuario'];
$password = $_POST['txt_password'];

// Preparar la consulta para evitar inyecciones SQL
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasenia = ?");
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    $_SESSION["SESION_ID"] = $fila['id']; // Asegúrate de que esta línea esté aquí
    $_SESSION["SESION_ROL"] = $fila['id_rol'];
    $_SESSION["SESION_NOMBRES"] = $fila['nombres'];
    $_SESSION["SESION_APELLIDOS"] = $fila['apellidos'];

    // Obtener el ID de la empresa del usuario
    $id_usuario = $fila['id'];
    $stmt_empresa = $conexion->prepare("SELECT id FROM empresas WHERE id_usuario = ?");
    $stmt_empresa->bind_param("i", $id_usuario);
    $stmt_empresa->execute();
    $resultado_empresa = $stmt_empresa->get_result();
    
    if ($fila_empresa = $resultado_empresa->fetch_assoc()) {
        $_SESSION["SESION_ID_EMPRESA"] = $fila_empresa['id'];
    }
    
    // Redirección según el rol del usuario
    header("Location: ../index.php");
    exit; // Siempre usa exit después de una redirección para evitar ejecuciones no deseadas
} else {
    header("Location: form_login.php?error_login=error");
    exit; // Asegúrate de llamar exit aquí también
}
?>
