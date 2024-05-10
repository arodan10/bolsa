<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

$where = " WHERE 1=1 ";
if (isset($_POST['buscar'])) {
    if (!empty($_POST['titulo'])) {
        $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
        $where .= " AND titulo LIKE '%$titulo%' ";
    }
    if (!empty($_POST['empresa'])) {
        $empresa = mysqli_real_escape_string($conexion, $_POST['empresa']);
        $where .= " AND id_empresa IN (SELECT id FROM empresas WHERE razon_social LIKE '%$empresa%') ";
    }
    if (!empty($_POST['ubicacion'])) {
        $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
        $where .= " AND ubicacion LIKE '%$ubicacion%' ";
    }
    if (!empty($_POST['tipo'])) {
        $tipo = mysqli_real_escape_string($conexion, $_POST['tipo']);
        $where .= " AND tipo='$tipo' ";
    }
}

$sql = "SELECT o.*, e.razon_social FROM oferta_laboral o JOIN empresas e ON o.id_empresa = e.id" . $where;
$registros = mysqli_query($conexion, $sql);

echo "<!-- Debug SQL: " . htmlspecialchars($sql) . " -->"; // Para depuración

?>
<?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'already_postulated') {
        echo "<div class='alert alert-warning'>Ya has postulado a esta oferta.</div>";
    } elseif ($status == 'success') {
        echo "<div class='alert alert-success'>Postulación realizada con éxito.</div>";
    } elseif ($status == 'error') {
        echo "<div class='alert alert-danger'>Error al postular.</div>";
    }
}
?>

<div class="container mt-5">
    <form method="POST">
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="titulo" placeholder="Título" value="<?php echo isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : ''; ?>">
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="<?php echo isset($_POST['empresa']) ? htmlspecialchars($_POST['empresa']) : ''; ?>">
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="ubicacion" placeholder="Ubicación" value="<?php echo isset($_POST['ubicacion']) ? htmlspecialchars($_POST['ubicacion']) : ''; ?>">
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" name="tipo">
                    <option value="">Seleccione Tipo</option>
                    <option value="presencial" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'presencial') ? 'selected' : ''; ?>>Presencial</option>
                    <option value="remoto" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'remoto') ? 'selected' : ''; ?>>Remoto</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()">Limpiar</button>

            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Empresa</th>
                <th>Fecha de Publicación</th>
                <th>Ubicación</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($fila = mysqli_fetch_array($registros)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['razon_social']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['fecha_publicacion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['ubicacion']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['tipo']) . "</td>";
                echo "<td><a class='btn btn-info' href='ver_oferta.php?id=" . $fila['id'] . "'>Ver Detalles</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include("../../includes/foot.php");
?>
<script>
    function resetForm() {
        window.location.href = window.location.pathname;
    }
</script>