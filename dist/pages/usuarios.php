<?php
include_once "Ctrl/head.php";
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
                        <h3 class="mb-0">Usuarios</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
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
                $('#usuariosTable').DataTable();
            });
        </script>

        <!---ESTILOS DE LA TABLA JQUERY --->

        <style>
            .container {
                margin-top: 20px;
            }

            .avatar-column img {
                width: 50px;
                height: 50px;
                object-fit: cover;
                border-radius: 50%;
                border: 2px solid #ddd;
            }

            .btn-actions {
                display: flex;
                gap: 5px;
            }
        </style>

       <!-- TABLA USUARIO -->
<div class="container mt-4">
    <table id="usuariosTable" class="table table-striped text-center">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre de Usuario</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
                <th>Último Acceso</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se llenarán los datos de los usuarios con PHP -->
            <?php
            include 'Cnx/conexion.php';
            // Consultar todos los usuarios
            $sql = "SELECT * FROM usuarios";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_Usuario'] . "</td>";
                    echo "<td>" . $row['Nombre_Usuario'] . "</td>";
                    echo "<td><img src='" . $row['Imagen'] . "' class='rounded-circle' width='50' height='50'></td>";
                    echo "<td>" . ($row['estado_usuario'] == 1 ? "<span class='badge bg-success'>Activo</span>" : "<span class='badge bg-danger'>Inactivo</span>") . "</td>";
                    echo "<td>" . $row['Fecha_Creacion'] . "</td>";
                    echo "<td>" . ($row['Ultimo_Acceso'] ? $row['Ultimo_Acceso'] : 'No disponible') . "</td>";
                    echo "<td>
                    <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#modalVerUsuario' data-id='" . $row['ID_Usuario'] . "' title='Ver'>
                        <i class='fas fa-eye'></i>
                    </button>
                  </td>";
                    echo "<td>
                    <a href='#' class='btn btn-warning btn-sm text-white' data-bs-toggle='modal' data-bs-target='#modalEditarUsuario' data-id='" . $row['ID_Usuario'] . "' title='Editar'>
                        <i class='fas fa-edit'></i>
                    </a>
                  </td>";
                    echo "<td>
                    <button class='btn btn-danger btn-sm' title='Eliminar'>
                        <i class='fas fa-trash-alt'></i>
                    </button>
                  </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No se encontraron usuarios</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para ver usuario -->
<div class="modal fade" id="modalVerUsuario" tabindex="-1" aria-labelledby="modalVerUsuarioLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerUsuarioLabel">Ver Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- ID de Usuario -->
                <div class="mb-3">
                    <label for="idUsuarioVer" class="form-label">ID de Usuario</label>
                    <input type="text" class="form-control" id="idUsuarioVer" disabled>
                </div>

                <!-- Nombre de Usuario -->
                <div class="mb-3">
                    <label for="nombreUsuarioVer" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombreUsuarioVer" disabled>
                </div>

                <!-- Imagen -->
                <div class="mb-3">
                    <label for="imagenUsuarioVer" class="form-label">Imagen</label>
                    <img id="imagenUsuarioVer" src="" alt="Imagen del Usuario" class="rounded-circle" width="50" height="50">
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="passwordUsuarioVer" class="form-label">Contraseña</label>
                    <input type="text" class="form-control" id="passwordUsuarioVer" disabled>
                </div>

                <!-- ID de Vendedor -->
                <div class="mb-3">
                    <label for="vendedorUsuarioVer" class="form-label">ID Vendedor</label>
                    <input type="text" class="form-control" id="vendedorUsuarioVer" disabled>
                </div>

                <!-- Estado del Usuario -->
                <div class="mb-3">
                    <label for="estadoUsuarioVer" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estadoUsuarioVer" disabled>
                </div>

                <!-- Fecha de Creación -->
                <div class="mb-3">
                    <label for="fechaCreacionUsuarioVer" class="form-label">Fecha de Creación</label>
                    <input type="text" class="form-control" id="fechaCreacionUsuarioVer" disabled>
                </div>

                <!-- Último Acceso -->
                <div class="mb-3">
                    <label for="ultimoAccesoUsuarioVer" class="form-label">Último Acceso</label>
                    <input type="text" class="form-control" id="ultimoAccesoUsuarioVer" disabled>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalVerUsuarioLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerUsuarioLabel">Ver Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- ID de Usuario -->
                <div class="mb-3">
                    <label for="idUsuarioVer" class="form-label">ID de Usuario</label>
                    <input type="text" class="form-control" id="idUsuarioVer" disabled>
                </div>

                <!-- Nombre de Usuario -->
                <div class="mb-3">
                    <label for="nombreUsuarioVer" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombreUsuarioVer" disabled>
                </div>

                <!-- Imagen -->
                <div class="mb-3">
                    <label for="imagenUsuarioVer" class="form-label">Imagen</label>
                    <img id="imagenUsuarioVer" src="" alt="Imagen del Usuario" class="rounded-circle" width="50" height="50">
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="passwordUsuarioVer" class="form-label">Contraseña</label>
                    <input type="text" class="form-control" id="passwordUsuarioVer" disabled>
                </div>

                <!-- ID de Vendedor -->
                <div class="mb-3">
                    <label for="vendedorUsuarioVer" class="form-label">ID Vendedor</label>
                    <input type="text" class="form-control" id="vendedorUsuarioVer" disabled>
                </div>

                <!-- Estado del Usuario -->
                <div class="mb-3">
                    <label for="estadoUsuarioVer" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estadoUsuarioVer" disabled>
                </div>

                <!-- Fecha de Creación -->
                <div class="mb-3">
                    <label for="fechaCreacionUsuarioVer" class="form-label">Fecha de Creación</label>
                    <input type="text" class="form-control" id="fechaCreacionUsuarioVer" disabled>
                </div>

                <!-- Último Acceso -->
                <div class="mb-3">
                    <label for="ultimoAccesoUsuarioVer" class="form-label">Último Acceso</label>
                    <input type="text" class="form-control" id="ultimoAccesoUsuarioVer" disabled>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



        <!-- <div class="contenedor">
                 <img src="../../dist/assets/img/logologin2.png" alt="Logo">
            </div>-->

        <script src="../js/editar_usuario.js?2345"></script>
        <script src="../js/ver_usuario.js?12345"></script>
        <script src="../js/mostar_filtro.js?1234"></script>
        <script src="../js/baja_usuario.js?1234"></script>
        <script src="../js/reactivar_usuario.js?12345"></script>


        <?php

        include_once "Ctrl/footer.php";
        ?>