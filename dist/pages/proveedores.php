<?php
include_once "Ctrl/head.php";
?>

<?php
// Incluir el archivo de conexión
include('../pages/Cnx/conexion.php');

// Consulta SQL para obtener los proveedores
$sql = "SELECT * FROM proveedor";
$result = $conn->query($sql);


?>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                    <!--- <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li>-->
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->

                    <!----ICONO DE LUP   <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i class="bi bi-search"></i> </a> </li> --->





                    <!--MENU DE USUARIO  PARTE SUPERRIOR ALA DERECHA -->

                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin:: menu desplegable del usuario-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="../../dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline">Alexander Pierce</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="../../dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer

                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->
                            <li class="user-body"> <!--begin::Row-->
                                <!-----  <div class="row">
                                    <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                                    <div class="col-4 text-center"> <a href="#">Ventas</a> </div>
                                    <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                                </div> ---> <!--end::Row-->

                            </li> <!--end::Menu Body--> <!--begin::Menu Footer-->
                            <li class="user-footer"> <a href="#" class="btn btn-default btn-flat"><!---Prefil--></a> <a href="#" id="btnCerrarSesion" class="btn btn-default btn-flat float-end">Cerrar sesión</a>
                                <!--end::Menu Footer-->

                                <!--MENU DE USUARIO  PARTE SUPERRIOR ALA DERECHA -->

                        </ul>
                    </li> <!--end::User Menu Dropdown-->

                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->

        <?php

        include_once "Ctrl/menu.php";
        ?>

        </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
    </aside> <!--end::Sidebar--> <!--begin::App Main-->
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">proveedores</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Proveedor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Menu
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->


        <!---table JQUERY -->
        <script>
            $(document).ready(function() {
                $('#proveedoresTable').DataTable();
            });
        </script>


        <!-- TABLA DE PROVEEDORES -->
        <div class="container">
            <div class="card p-3 shadow-sm">
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarProveedor">
                        <i class="fas fa-plus-circle"></i> Agregar
                    </button>
                    <h3 class="text-center flex-grow-1">Lista de Proveedores</h3>
                </div>

                <table id="proveedoresTable" class="display text-center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Empresa/Laboratorio</th>
                            <th>Correo</th>
                            <th>Ciudad</th>
                            <th>Teléfono</th>
                            <th>RUC</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['ID_Proveedor'] ?></td>
                                <td><?= $row['Nombre'] ?> <?= $row['Apellido'] ?></td>
                                <td><?= $row['Empresa_Laboratorio'] ?></td>
                                <td><?= $row['Email'] ?></td>
                                <td><?= $row['Ciudad'] ?></td>
                                <td><?= $row['Telefono'] ?></td>
                                <td><?= $row['RUC'] ?></td>
                                <td class='btn-actions'>
                                    <button class='btn btn-success VerProveedorBtn' data-bs-toggle='modal' data-bs-target='#modalVerProveedor' data-id='<?= $row['ID_Proveedor'] ?>'>
                                        <i class='fas fa-eye'></i>
                                    </button>
                                    <a href='' class='btn btn-warning editarProveedorBtn' data-bs-toggle='modal' data-bs-target='#modalEditarProveedor' data-id='<?= $row['ID_Proveedor'] ?>'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                    <button class='btn btn-danger bajaProveedorBtn' data-id='<?= $row['ID_Proveedor'] ?>'>
                                        <i class='fas fa-trash-alt'></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal para agregar proveedor -->
        <div class="modal fade" id="modalAgregarProveedor" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../pages/Ctrl/agregar_proveedor.php" method="POST">
                        <div class="modal-body">
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombreProveedor" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreProveedor" id="nombreProveedor" required>
                            </div>

                            <!-- Apellido -->
                            <div class="mb-3">
                                <label for="apellidoProveedor" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellidoProveedor" id="apellidoProveedor" required>
                            </div>

                            <!-- Empresa/Laboratorio -->
                            <div class="mb-3">
                                <label for="empresaLaboratorioProveedor" class="form-label">Empresa/Laboratorio</label>
                                <input type="text" class="form-control" name="empresaLaboratorioProveedor" id="empresaLaboratorioProveedor" required>
                            </div>

                            <!-- Dirección -->
                            <div class="mb-3">
                                <label for="direccionProveedor" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccionProveedor" id="direccionProveedor" required>
                            </div>

                            <!-- Ciudad -->
                            <div class="mb-3">
                                <label for="ciudadProveedor" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudadProveedor" id="ciudadProveedor" required>
                            </div>

                            <!-- Departamento -->
                            <div class="mb-3">
                                <label for="departamentoProveedor" class="form-label">Departamento</label>
                                <input type="text" class="form-control" name="departamentoProveedor" id="departamentoProveedor" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefonoProveedor" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefonoProveedor" id="telefonoProveedor" required>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="mb-3">
                                <label for="emailProveedor" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="emailProveedor" id="emailProveedor" required>
                            </div>

                            <!-- RUC -->
                            <div class="mb-3">
                                <label for="rucProveedor" class="form-label">RUC</label>
                                <input type="text" class="form-control" name="rucProveedor" id="rucProveedor" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Editar Proveedor -->
        <div class="modal fade" id="modalEditarProveedor" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Editar Proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../pages/Ctrl/actualizar_proveedor.php" method="POST">
                        <input type="hidden" name="idProveedor" id="idProveedor"> <!-- Campo oculto para ID del proveedor -->

                        <div class="modal-body">
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombreProveedor" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre_Proveedor" id="nombre_Proveedor" required>
                            </div>

                            <!-- Apellido -->
                            <div class="mb-3">
                                <label for="apellidoProveedor" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellido_Proveedor" id="apellido_Proveedor" required>
                            </div>

                            <!-- Empresa/Laboratorio -->
                            <div class="mb-3">
                                <label for="empresaLaboratorio" class="form-label">Empresa/Laboratorio</label>
                                <input type="text" class="form-control" name="empresa_Laboratorio" id="empresa_Laboratorio" required>
                            </div>

                            <!-- Dirección -->
                            <div class="mb-3">
                                <label for="direccionProveedor" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccion_Proveedor" id="direccion_Proveedor" required>
                            </div>

                            <!-- Ciudad -->
                            <div class="mb-3">
                                <label for="ciudadProveedor" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad_Proveedor" id="ciudad_Proveedor" required>
                            </div>

                            <!-- Departamento -->
                            <div class="mb-3">
                                <label for="departamentoProveedor" class="form-label">Departamento</label>
                                <input type="text" class="form-control" name="departamento_Proveedor" id="departamento_Proveedor" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefonoProveedor" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono_Proveedor" id="telefono_Proveedor" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="emailProveedor" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="email_Proveedor" id="email_Proveedor" required>
                            </div>

                            <!-- RUC -->
                            <div class="mb-3">
                                <label for="rucProveedor" class="form-label">RUC</label>
                                <input type="text" class="form-control" name="ruc_Proveedor" id="ruc_Proveedor" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Ver Proveedor -->
        <div class="modal fade" id="modalVerProveedor" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Ver Proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre_Proveedor" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre_Proveedor" id="nombre_Proveedor" disabled>
                        </div>

                        <!-- Apellido -->
                        <div class="mb-3">
                            <label for="apellido_Proveedor" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido_Proveedor" id="apellido_Proveedor" disabled>
                        </div>

                        <!-- Empresa/Laboratorio -->
                        <div class="mb-3">
                            <label for="empresa_Laboratorio" class="form-label">Empresa/Laboratorio</label>
                            <input type="text" class="form-control" name="empresa_Laboratorio" id="empresa_Laboratorio" disabled>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="direccion_Proveedor" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion_Proveedor" id="direccion_Proveedor" disabled>
                        </div>

                        <!-- Ciudad -->
                        <div class="mb-3">
                            <label for="ciudad_Proveedor" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad_Proveedor" id="ciudad_Proveedor" disabled>
                        </div>

                        <!-- Departamento -->
                        <div class="mb-3">
                            <label for="departamento_Proveedor" class="form-label">Departamento</label>
                            <input type="text" class="form-control" name="departamento_Proveedor" id="departamento_Proveedor" disabled>
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label for="telefono_Proveedor" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono_Proveedor" id="telefono_Proveedor" disabled>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email_Proveedor" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="email_Proveedor" id="email_Proveedor" disabled>
                        </div>

                        <!-- RUC -->
                        <div class="mb-3">
                            <label for="ruc_Proveedor" class="form-label">RUC</label>
                            <input type="text" class="form-control" name="ruc_Proveedor" id="ruc_Proveedor" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>










        <script src="../js/editar_proveedor.js?2345"></script>
        <script src="../js/ver_provee.js?12345"></script>


        <?php

        include_once "Ctrl/footer.php";
        ?>