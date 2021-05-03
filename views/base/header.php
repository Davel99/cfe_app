<!DOCTYPE html>
<html lang="es" dir="ltr">
        <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- Bootstrap core CSS -->
                <link href="<?= base_url ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <!-- Custom styles for this template -->
                <link href="<?= base_url ?>assets/css/simple-sidebar.css" rel="stylesheet">

                <link href="<?= base_url ?>assets/css/constants.css" rel="stylesheet">
                <link href="<?= base_url ?>assets/css/style.css" rel="stylesheet">



                <title>CFE app</title>

        </head>
        <body>

                <div class="d-flex" id="wrapper">

                        <!-- Sidebar -->
                        <div class="bg-dark border-right" id="sidebar-wrapper">

                                <div class="menu-head">

                                        <img src="<?= base_url ?>assets/images/CFE_logo.jpg" width="100">

                                </div>
                                <div class="list-group list-group-flush">

                                        <li class="active">

                                                <!--OPCIONES DEL ADMINISTRADOR-->
                                                <?php if (isset($_SESSION['user']['admin'])): ?>

                                                        <a href="<?= base_url ?>admin/archivos" class="list-group-item list-group-item-action bg-dark icon-container">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/people-fill.svg">
                                                                <h6>GESTIONAR ARCHIVOS</h6>
                                                        </a>

                                                        <a href="<?= base_url ?>admin/usuarios" class="list-group-item list-group-item-action bg-dark icon-container">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/server.svg">
                                                                <h6>GESTIONAR USUARIOS</h6>
                                                        </a>

                                                <?php elseif (isset($_SESSION['user'])): ?>


                                                        <!--OPCIONES DE USUARIOS COMUNES-->

                                                        <a href="<?= base_url ?>" class="list-group-item list-group-item-action bg-dark icon-container">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/bookmark.svg">
                                                                <h6>INICIO</h6>
                                                        </a>

                                                        <a href="#perm-list" data-toggle="collapse" class="icon-container list-group-item list-group-item-action bg-dark" aria-expanded="false" class="dropdown-toggle">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/person-check.svg">
                                                                <h6>PERMISIONARIOS</h6>
                                                        </a>
                                                        <ul class="collapse list-unstyled" id="perm-list">
                                                                <li>
                                                                        <a href="<?= base_url ?>permisionarios/lista" class="list-group-item list-group-item-action bg-dark sub-list icon-container">
                                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/list.svg">
                                                                                <h6>VER LISTA</h6>

                                                                        </a>
                                                                </li>

                                                                <li>
                                                                        <a href="<?= base_url ?>permisionarios/modificar" class="list-group-item list-group-item-action bg-dark sub-list icon-container">
                                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/person-plus.svg">
                                                                                <h6>MODIFICAR</h6>
                                                                        </a>
                                                                </li>

                                                                <li>
                                                                        <a href="<?= base_url ?>permisionarios/eliminar" class="list-group-item list-group-item-action bg-dark sub-list icon-container">
                                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/person-dash-fill.svg">
                                                                                <h6>ELIMINAR</h6>
                                                                        </a>
                                                                </li>
                                                        </ul>

                                                        <a href="<?= base_url ?>precolisiones/seleccionar" class="list-group-item list-group-item-action bg-dark icon-container">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/folder.svg">
                                                                <h6>PRECOLISIONES</h6>
                                                        </a>
                                                        <a href="<?= base_url ?>usuario/contraseña" class="list-group-item list-group-item-action bg-dark icon-container">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/shield-lock.svg">
                                                                <h6>CAMBIAR CONTRASEÑA</h6>
                                                        </a>

                                                <?php else: ?>

                                                        <!--ANTES DE QUE EL USUARIO INICIE SESIÓN-->

                                                        <a href="<?= base_url ?>registro/" class="list-group-item list-group-item-action bg-dark icon-container">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/person-bounding-box.svg">
                                                                <h6>REGISTRO</h6>
                                                        </a>

                                                        <a href="<?= base_url ?>login/" class="list-group-item list-group-item-action bg-dark icon-container">
                                                                <img src="<?= base_url ?>vendor/bootstrap/icons/people-circle.svg">
                                                                <h6>LOGIN</h6>
                                                        </a>

                                                <?php endif; ?>

                                        </li>


                                </div>
                        </div>
                        <!-- /#sidebar-wrapper -->

                        <!-- Page Content -->
                        <div id="page-content-wrapper">

                                <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                                        <!-- MENU BUTTON -->
                                        <button class="btn btn-dark" id="menu-toggle"><img src="<?= base_url ?>vendor/bootstrap/icons/list.svg" class="icon" style="filter: invert(100%);"></button>

                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                                                        <?php if (isset($_SESSION['user']['name'])): ?>

                                                                <li class="nav-item">
                                                                        <a class="nav-link" href="#"><b>USUARIO: </b><?= $_SESSION['user']['name'] ?> </a>
                                                                </li>



                                                                <li class="nav-item">
                                                                        <a class="nav-link" href="<?= base_url ?>unset/user_sess">Cerrar sesión</a>
                                                                </li>

<!--                                                                <li class="nav-item dropdown">
                                                                        <a class="nav-link dropdown-toggle" style="display:flex;"href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <img src="base_url vendor/bootstrap/icons/gear-fill.svg" width="20" height="20" style="filter: invert(100%);">
                                                                                <h6> ADMIN OPTIONS</h6>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                        </div>
                                                                </li>-->
                                                        <?php endif; ?>
                                                </ul>
                                        </div>
                                </nav>

                                <main class="col-md-12 bg-light">
