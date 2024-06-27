<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

$sql = "SELECT o.*, e.razon_social, 
    (SELECT COUNT(*) FROM postulaciones p WHERE p.id_oferta = o.id) AS postulantes_actuales
    FROM oferta_laboral o 
    JOIN empresas e ON o.id_empresa = e.id";
$registros = mysqli_query($conexion, $sql);

?>

<div class="container-fluid mt-4">
    <h1 class="text-center mb-4">Listado de Ofertas Laborales</h1>
    <table class="table table-bordered table-striped ">
        <thead class="table-dark">
            <tr>
                <th>Empresa</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha de Publicación</th>
                <th>Fecha de Cierre</th>
                <th>Remuneración</th>
                <th>Ubicación</th>
                <th>Tipo</th>
                <th>Postularon</th>
                <th>Vacantes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($fila = mysqli_fetch_array($registros)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['razon_social']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
                echo "<td>" . nl2br(htmlspecialchars($fila['descripcion'])) . "</td>";
                echo "<td>" . htmlspecialchars($fila['fecha_publicacion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['fecha_cierre']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['remuneracion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['ubicacion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['tipo']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['postulantes_actuales']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['limite_postulante']) . "</td>";
                echo "<td class='text-center'>";
            ?>
                <button type="button" class="btn btn-sm btn-primary mb-1" onClick="f_editar('<?php echo $fila['id']; ?>');">
                    <i class="fas fa-edit"></i> Editar
                </button>
                <button type="button" class="btn btn-sm btn-danger" onClick="f_eliminar('<?php echo $fila['id']; ?>');">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include("../../includes/foot.php");

function obtenerNombreEmpresa($conexion, $id_empresa) {
    $sql = "SELECT razon_social FROM empresas WHERE id='$id_empresa'";
    $resultado = mysqli_query($conexion, $sql);
    if ($fila = mysqli_fetch_array($resultado)) {
        return $fila;
    } else {
        return false;
    }
}
?>

<script>
    function f_editar(id) {
        location.href = "modificar_oferta.php?id=" + id;
    }

    function f_eliminar(id) {
        if (confirm('¿Está seguro de eliminar esta oferta laboral?')) {
            location.href = "eliminar_oferta.php?id=" + id;
        }
    }
</script>
