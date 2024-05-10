<?php
include("../../includes/head.php");
include("../../includes/conectar.php");
$conexion = conectar();
// Definir variables para cada filtro
$razon_social = $_GET['razon_social'] ?? '';
$ruc = $_GET['ruc'] ?? '';
$telefono = $_GET['telefono'] ?? '';
$correo = $_GET['correo'] ?? '';
$nombre_usuario = $_GET['nombre_usuario'] ?? '';

// Crear la consulta SQL basada en los filtros
$sql = "SELECT empresas.*, usuarios.usuario AS nombre_usuario FROM empresas
        LEFT JOIN usuarios ON empresas.id_usuario = usuarios.id WHERE 1=1";

if (!empty($razon_social)) {
  $sql .= " AND empresas.razon_social LIKE '%" . mysqli_real_escape_string($conexion, $razon_social) . "%'";
}
if (!empty($ruc)) {
  $sql .= " AND empresas.ruc LIKE '%" . mysqli_real_escape_string($conexion, $ruc) . "%'";
}
if (!empty($telefono)) {
  $sql .= " AND empresas.telefono LIKE '%" . mysqli_real_escape_string($conexion, $telefono) . "%'";
}
if (!empty($correo)) {
  $sql .= " AND empresas.correo LIKE '%" . mysqli_real_escape_string($conexion, $correo) . "%'";
}
if (!empty($nombre_usuario)) {
  $sql .= " AND usuarios.usuario LIKE '%" . mysqli_real_escape_string($conexion, $nombre_usuario) . "%'";
}

$registros = mysqli_query($conexion, $sql);
?>
<div class="container-fluid">
  <h1 class="mt-4">Lista de Empresas</h1>
  <div class="card card-body bg-light mb-4">
    <form method="get" class="row g-3">
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Razón Social	" name="razon_social" value="<?php echo $razon_social; ?>">
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="RUC	" name="ruc" value="<?php echo $ruc; ?>">
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Teléfono	" name="telefono" value="<?php echo $telefono; ?>">
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Correo" name="correo" value="<?php echo $correo; ?>">
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Usuario Asignado	" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <button type="button" class="btn btn-secondary" onclick="resetForm()">Limpiar</button>
      </div>
    </form>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover mt-3">
      <thead class="thead-dark">
        <tr>
          <th>Razón Social</th>
          <th>RUC</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Usuario Asignado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($fila = mysqli_fetch_array($registros)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($fila['razon_social']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['ruc']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['direccion']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
          echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
          echo "<td>" . ($fila['nombre_usuario'] ? htmlspecialchars($fila['nombre_usuario']) : 'No asignado') . "</td>";
          echo "<td>";
          echo "<button type='button' class='btn btn-primary mr-1' onClick='f_editar(\"{$fila['id']}\");'><i class='fas fa-edit'></i></button>";
          echo "<button type='button' class='btn btn-danger mr-1' onClick='f_eliminar(\"{$fila['id']}\");'><i class='fas fa-trash-alt'></i></button>";

          if ($fila['id_usuario']) {
            echo "<button type='button' class='btn btn-warning' onClick='f_desasignar(\"{$fila['id']}\");'><i class='fas fa-user-minus'></i> Desasignar Usuario</button>";
          } else {
            echo "<button type='button' class='btn btn-info' data-toggle='modal' data-target='#asignarUsuarioModal{$fila['id']}'><i class='fas fa-user-plus'></i> Asignar Usuario</button>";
          }

          include('modal_asignar_usuario.php');
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
  function f_editar(id) {
    location.href = "modificar_empresa.php?id=" + id;
  }

  function f_eliminar(id) {
    if (confirm('¿Está seguro de eliminar esta empresa?')) {
      location.href = "eliminar_empresa.php?id=" + id;
    }
  }

  function f_desasignar(id) {
    if (confirm('¿Está seguro de desasignar el usuario de esta empresa?')) {
      location.href = "desasignar_usuario.php?id=" + id;
    }
  }
</script>
<script>
  function resetForm() {
    window.location.href = window.location.pathname;
  }
</script>
<?php
include("../../includes/foot.php");
?>