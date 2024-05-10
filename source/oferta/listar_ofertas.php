<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

$sql = "SELECT * FROM oferta_laboral";
$registros = mysqli_query($conexion, $sql);

echo "<div class='container-fluid'>";
echo "<h1>Listado de Ofertas Laborales</h1>";
echo "<table class='table table-success table-hover'>";
echo "<th>Empresa</th><th>Título</th><th>Descripción</th><th>Fecha de Publicación</th><th>Fecha de Cierre</th><th>Remuneración</th><th>Ubicación</th><th>Tipo</th><th>Límite de Postulantes</th><th>Acciones</th>";
while ($fila = mysqli_fetch_array($registros)) {
    echo "<tr>";
    // Obtener el nombre de la empresa utilizando el id_empresa
    $nombre_empresa = obtenerNombreEmpresa($conexion, $fila['id_empresa']);
    echo "<td>" . $nombre_empresa['razon_social'] . "</td>";
    echo "<td>" . $fila['titulo'] . "</td>";
    echo "<td>" . $fila['descripcion'] . "</td>";
    echo "<td>" . $fila['fecha_publicacion'] . "</td>";
    echo "<td>" . $fila['fecha_cierre'] . "</td>";
    echo "<td>" . $fila['remuneracion'] . "</td>";
    echo "<td>" . $fila['ubicacion'] . "</td>";
    echo "<td>" . $fila['tipo'] . "</td>";
    echo "<td>" . $fila['limite_postulante'] . "</td>";
    echo "<td>";
?>
    <button type="button" class="btn btn-primary" onClick="f_editar('<?php echo $fila['id']; ?>');">Editar</button>
    <button type="button" class="btn btn-danger" onClick="f_eliminar('<?php echo $fila['id']; ?>');">Eliminar</button>
<?php
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

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
    if (confirm('¿Está seguro de eliminar esta empresa?')) {
      location.href = "eliminar_oferta.php?id=" + id;
    }
  }
</script>
