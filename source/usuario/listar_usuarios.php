    <?php
    include("../../includes/head.php");
    include("../../includes/conectar.php");
    $conexion = conectar();

    // Definir variables para cada filtro
    $usuario = $_GET['usuario'] ?? '';
    $nombre = $_GET['nombre'] ?? '';
    $apellido = $_GET['apellido'] ?? '';
    $dni = $_GET['dni'] ?? '';
    $rol = $_GET['rol'] ?? '';

    // Crear la consulta SQL basada en los filtros
    $sql = "SELECT * FROM usuarios WHERE 1=1";
    if (!empty($usuario)) {
        $sql .= " AND usuario LIKE '%" . mysqli_real_escape_string($conexion, $usuario) . "%'";
    }
    if (!empty($nombre)) {
        $sql .= " AND nombres LIKE '%" . mysqli_real_escape_string($conexion, $nombre) . "%'";
    }
    if (!empty($apellido)) {
        $sql .= " AND apellidos LIKE '%" . mysqli_real_escape_string($conexion, $apellido) . "%'";
    }
    if (!empty($dni)) {
        $sql .= " AND dni LIKE '%" . mysqli_real_escape_string($conexion, $dni) . "%'";
    }
    if ($rol !== '') {
        $sql .= " AND id_rol = '" . mysqli_real_escape_string($conexion, $rol) . "'";
    }
    $registros = mysqli_query($conexion, $sql);

    // Arreglo para mapear id_rol a nombres de roles
    $roles = [
        0 => ['name' => 'Usuario', 'color' => '#f8d7da'],
        1 => ['name' => 'Admin', 'color' => '#d4edda'],
        2 => ['name' => 'Empresa', 'color' => '#d1ecf1'],
        3 => ['name' => 'Postulante', 'color' => '#fff3cd']
    ];
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1>Lista de Usuarios</h1>
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registroUsuarioModal"><i class="fas fa-plus"></i> Agregar Usuario</button>
        </div>

        <!-- Modal para registro de usuario -->
        <div class="modal fade" id="registroUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="registroUsuarioModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registroUsuarioModalLabel">Registrar Nuevo Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="guardar_usuario.php" method="post">
                            <div class="row mb-3">
                                <label for="txt_nombres" class="col-sm-2 col-form-label">Nombres</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txt_nombres" id="txt_nombres" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="txt_apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="txt_dni" class="col-sm-2 col-form-label">DNI</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txt_dni" id="txt_dni" pattern="\d{8}" title="Ingresa un DNI válido de 8 dígitos" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="txt_direccion" class="col-sm-2 col-form-label">Dirección</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txt_direccion" id="txt_direccion" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="txt_telefono" class="col-sm-2 col-form-label">Teléfono</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" pattern="\d{9}" title="Ingresa un número de teléfono válido de 9 dígitos" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="txt_usuario" class="col-sm-2 col-form-label">Usuario</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="txt_usuario" id="txt_usuario" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="txt_contrasenia" class="col-sm-2 col-form-label">Contraseña</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="txt_contrasenia" id="txt_contrasenia" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Formulario de Filtros -->
        <!-- Formulario de Filtros -->
        <div class="card card-body bg-light mb-4">
            <form method="get" class="row g-3">
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Usuario" name="usuario" value="<?php echo $usuario; ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Apellido" name="apellido" value="<?php echo $apellido; ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="D.N.I." name="dni" value="<?php echo $dni; ?>">
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="rol">
                        <option value="">Todos los Roles</option>
                        <?php foreach ($roles as $key => $role) {
                            echo "<option value='$key'" . ($key == $rol ? ' selected' : '') . ">" . htmlspecialchars($role['name']) . "</option>";
                        } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Limpiar</button>
                </div>
            </form>
        </div>

        <!-- Tabla de usuarios con filtros aplicados -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>CV</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_array($registros)) { ?>
                    <tr style="background-color: <?php echo $roles[$fila['id_rol']]['color']; ?>">
                        <td><?php echo htmlspecialchars($fila['nombres']); ?></td>
                        <td><?php echo htmlspecialchars($fila['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($fila['dni']); ?></td>
                        <td><?php echo htmlspecialchars($fila['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($fila['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($fila['usuario']); ?></td>
                        <td>
                            <span class="badge badge-<?php echo ($fila['id_rol'] === 1 ? 'success' : ($fila['id_rol'] === 0 ? 'secondary' : ($fila['id_rol'] === 2 ? 'info' : 'warning'))); ?>">
                                <?php echo htmlspecialchars($roles[$fila['id_rol']]['name']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($fila['ruta_cv']) : ?>
                                <!-- Enlace que activa el modal -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalCV<?php echo $fila['id']; ?>">
                                    <i class="fas fa-file-pdf"></i> Ver CV
                                </button>

                                <!-- Modal que muestra el PDF -->
                                <div class="modal fade" id="modalCV<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cvModalLabel<?php echo $fila['id']; ?>">CV de <?php echo htmlspecialchars($fila['nombres']); ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Incorporar el PDF en el modal -->
                                                <object data="<?php echo htmlspecialchars($fila['ruta_cv']); ?>" type="application/pdf" width="100%" height="500px">
                                                    <p>Tu navegador no tiene un visor de PDF. Puedes descargar el PDF para verlo: <a href="<?php echo htmlspecialchars($fila['ruta_cv']); ?>">Descargar PDF</a>.</p>
                                                </object>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <span>No disponible</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="javascript:f_editar('<?php echo $fila['id']; ?>');" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="javascript:f_eliminar('<?php echo $fila['id']; ?>');" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#asignarRolModal<?php echo $fila['id']; ?>"><i class="fas fa-user-tag"></i></a>
                        </td>
                    </tr>
                    <?php include('modal_asignar_rol.php'); // Asegúrate de que este archivo existe y está correctamente configurado 
                    ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
    include("../../includes/foot.php");
    ?>
    <script>
        function f_editar(id) {
            location.href = "modificar_usuario.php?id=" + id;
        }

        function f_eliminar(id) {
            if (confirm('¿Está seguro de eliminar este usuario?')) {
                location.href = "eliminar_usuario.php?id=" + id;
            }
        }
    </script>
    <script>
        function resetForm() {
            window.location.href = window.location.pathname;
        }
    </script>