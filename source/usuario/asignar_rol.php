<?php
include("../../includes/conectar.php");  // Asegúrate de que este archivo contiene la función conectar() que devuelve la conexión a la base de datos.

// Comprobar que se reciben los datos del formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario_id']) && isset($_POST['rol'])) {
    $usuario_id = $_POST['usuario_id'];
    $rol_id = $_POST['rol'];

    $conexion = conectar();

    // Preparar y bindear
    $stmt = $conexion->prepare("UPDATE usuarios SET id_rol = ? WHERE id = ?");
    $stmt->bind_param("ii", $rol_id, $usuario_id);

    // Ejecutar
    if ($stmt->execute()) {
        // Redireccionar de vuelta a la lista de usuarios con mensaje de éxito
        header("Location: listar_usuarios.php");
    } else {
        // Redireccionar con mensaje de error
        header("Location: listar_usuarios.php");
    }

    // Cerrar statement
    $stmt->close();
    // Cerrar conexión
    $conexion->close();
} else {
    // Redireccionar si no se accede correctamente al script o faltan datos
    header("Location: listar_usuarios.php");
}
?>
