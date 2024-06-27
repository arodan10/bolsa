<?php
include("config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEMA DE BOLSA LABORAL</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo RUTAGENERAL; ?>templates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo RUTAGENERAL; ?>templates/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.theme.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Inicio - Sidebar (Menú Izquierdo) -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo RUTAGENERAL; ?>index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Bolsa Laboral</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Inico -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <?php
if (!isset($_SESSION["SESION_NOMBRES"])) {
    // Aquí puedes colocar código adicional si el usuario no está autenticado
} else {
?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/usuario/perfil.php">
            <i class="fas fa-user-circle fa-fw"></i> <!-- Icono de usuario -->
            <span>Perfil</span>
        </a>
    </li>
<?php
}
?>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interfaz
            </div>
            <?php
            if (isset($_SESSION['SESION_ROL']) && $_SESSION['SESION_ROL'] == 1) {
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <?php

                }
                ?>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php if (!isset($_SESSION["SESION_ID"])) { ?>
                            <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/usuario/registro_usuarios.php">Registrar usuario</a>
                        <?php } ?>
                        <?php
                        if (isset($_SESSION['SESION_ROL']) && $_SESSION['SESION_ROL'] == 1) {
                        ?>
                            <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/usuario/registro_usuarios.php">Registrar Usuarios</a>
                        <?php

                        }
                        ?>
                        <?php
                        if (isset($_SESSION['SESION_ROL']) && $_SESSION['SESION_ROL'] == 1) {
                        ?>
                            <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/usuario/listar_usuarios.php">Lista de Usuarios</a>
                        <?php

                        }
                        ?>
                        <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a> -->
                    </div>
                </div>
            </li>
            

            <?php
            if (isset($_SESSION['SESION_ROL']) && $_SESSION['SESION_ROL'] == 1) {
            ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-industry"></i>
                        <span>Empresas</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            if (isset($_SESSION['SESION_ROL']) == 1 && $_SESSION['SESION_ROL'] == 1) {
                            ?>
                                <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/empresa/registrar_empresa.php">Registrar Empresa</a>
                                <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/empresa/listar_empresas.php">Listar Empresas</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </li>
            <?php

            }
            ?>



            <?php
            if (isset($_SESSION["SESION_ROL"]) && ($_SESSION["SESION_ROL"] == '1' || $_SESSION["SESION_ROL"] == '2')) {
            ?>
                <!-- Nav Item - Listar usuarios -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/oferta/registrar_ofertas.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Crear Oferta</span></a>
                </li>
            <?php
            }
            ?>

            <?php
            if (isset($_SESSION["SESION_ROL"]) && $_SESSION["SESION_ROL"] == '1') {
            ?>
                <!-- Nav Item - Listar usuarios -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/oferta/listar_ofertas.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Listar Ofertas</span></a>
                </li>
            <?php
            }
            ?>

            <?php
            // Comprobar si la sesión tiene definido el rol y si es Admin (1) o Postulante (3)
            if (isset($_SESSION["SESION_ROL"]) && ($_SESSION["SESION_ROL"] == '1' || $_SESSION["SESION_ROL"] == '3')) {
            ?>
                <!-- Nav Item - Buscar ofertas -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/oferta/buscar_ofertas.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Buscar Ofertas</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            // Comprobar si la sesión tiene definido el rol y si es Admin (1) o Postulante (3)
            if (isset($_SESSION["SESION_ROL"]) && ($_SESSION["SESION_ROL"] == '1' || $_SESSION["SESION_ROL"] == '3')) {
            ?>
                <!-- Nav Item - Buscar ofertas -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/oferta/listar_postulaciones.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Mis postulaciones</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            // Comprobar si la sesión tiene definido el rol y si es Admin (1) o Postulante (3)
            if (isset($_SESSION["SESION_ROL"]) && ($_SESSION["SESION_ROL"] == '1' || $_SESSION["SESION_ROL"] == '2')) {
            ?>
                <!-- Nav Item - Buscar ofertas -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/oferta/listar_ofertas_empresa.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>ofertas creadas</span>
                    </a>
                </li>
            <?php
            }
            ?>
            


            

            





            <!-- Nav Item - iniciar / cerrar sesion -->
            <?php
            if (!isset($_SESSION["SESION_NOMBRES"])) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/form_login.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Iniciar Sesión</span></a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/logout.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Cerrar Sesión</span></a>
                </li>
            <?php
            }
            ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fin - Sidebar (Menú Izquierdo) -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <?php
                    if (isset($_SESSION['SESION_NOMBRES']))
                        echo "Bienvenido " . $_SESSION['SESION_NOMBRES'] . " " . $_SESSION['SESION_APELLIDOS'];
                    else
                        echo "Inicie sesión.";

                    ?>

                </nav>
                <!-- End of Topbar -->
                <!-- End HEAD.PHP -->