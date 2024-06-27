<?php
include("../../includes/head.php");
include("../../includes/conectar.php");

$conexion = conectar();

// Asumimos que el ID de la empresa está almacenado en la sesión
$id_empresa = $_SESSION['SESION_ID_EMPRESA'];

$sql = "SELECT * FROM oferta_laboral WHERE id_empresa = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_empresa);
$stmt->execute();
$resultado = $stmt->get_result();

?>

<div class="container mt-5">
    <h2 class="mb-4">Ofertas Publicadas por Mi Empresa</h2>
    <div class="row mb-3">
        <div class="col text-right">
            <a href="registrar_ofertas.php" class="btn btn-success"><i class="fa fa-plus"></i> Añadir Oferta</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Título</th>
                    <th>Fecha de Publicación</th>
                    <th>Fecha de Cierre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($oferta = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($oferta['titulo']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($oferta['fecha_publicacion'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($oferta['fecha_cierre'])); ?></td>
                    <td><?php echo htmlspecialchars($oferta['tipo']); ?></td>
                    <td>
                        <a href="ver_postulantes.php?id_oferta=<?php echo $oferta['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-users"></i> Ver Postulantes</a>
                        <a href="modificar_oferta.php?id=<?php echo $oferta['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <a href="eliminar_oferta.php?id=<?php echo $oferta['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta oferta?');"><i class="fas fa-trash-alt"></i> Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../../includes/foot.php"); ?>
