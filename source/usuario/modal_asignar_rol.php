<!-- Modal para asignar roles -->
<div class="modal fade" id="asignarRolModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="asignar_rol.php" method="post">
                    <input type="hidden" name="usuario_id" value="<?php echo $fila['id']; ?>">
                    <div class="mb-3">
                        <label for="role">Seleccione el Rol:</label>
                        <select class="form-control" name="rol">
                            <?php
                            foreach ($roles as $key => $role) {
                                $selected = ($fila['id_rol'] == $key) ? 'selected' : '';
                                echo "<option value='$key' $selected>" . htmlspecialchars($role['name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Asignar Rol</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>