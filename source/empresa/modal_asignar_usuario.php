<div class="modal fade" id="asignarUsuarioModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="asignarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignarUsuarioModalLabel">Asignar Usuario a Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal: formulario para asignar usuario -->
                <form action="asignar_usuario.php" method="POST">
                    <input type="hidden" name="id_empresa" value="<?php echo $fila['id']; ?>">
                    <div class="form-group">
                        <label for="usuario">Seleccionar Usuario:</label>
                        <select class="form-control" name="id_usuario" required>
                            <?php
                            $usuarios = mysqli_query($conexion, "SELECT id, nombres FROM usuarios WHERE asignacion=0");
                            if (mysqli_num_rows($usuarios) > 0) {
                                while ($user = mysqli_fetch_array($usuarios)) {
                                    echo "<option value='" . $user['id'] . "'>" . $user['nombres'] . "</option>";
                                }
                            } else {
                                echo "<option>No hay usuarios disponibles</option>";    
                            }
                            ?>
                        </select>
                    </div>
                    <?php if ($fila['id_usuario'] != 0) : // Asumiendo que 0 significa no asignado 
                    ?>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </div>
                    <?php else : ?>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>