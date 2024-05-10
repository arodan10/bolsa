<?php
    include "includes/head.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
    <!-- Todo -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <?php 
                if (isset($_SESSION['SESION_ROL']) && $_SESSION['SESION_ROL'] == '0') {
                    echo '<div class="alert alert-success mt-4" role="alert">';
                    echo '<h4 class="alert-heading">Registro Exitoso!</h4>';
                    echo '<p>Tu registro ha sido procesado correctamente.</p>';
                    echo '<hr>';
                    echo '<p class="mb-0">Por favor permanece atento a la autorización de tu acceso por un administrador. Gracias por registrarte en nuestro Sistema de Bolsa Laboral.</p>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
    <!-- Fin de la zona central del sistema -->
</div>
<!-- /.container-fluid -->
<?php
//     if (isset($_SESSION['SESION_ROL']) && $_SESSION['SESION_ROL'] == '3') {
//         include("source/oferta/buscar_oferta.php");

//     }
// ?>
<?php
    include_once("includes/foot.php");
?>
