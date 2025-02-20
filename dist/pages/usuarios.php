<?php
include_once "Ctrl/head.php";
?>


<?php
// Incluir el archivo de conexión
include('../pages/Cnx/conexion.php');

// Verificar si se ha seleccionado un filtro de estado
$estado = isset($_GET['estado']) ? intval($_GET['estado']) : 1; // Por defecto, mostrar solo usuarios activos

// Consulta SQL para obtener los usuarios y el nombre del rol
$sql = "SELECT usuarios.*, roles.Nombre_Rol 
        FROM usuarios 
        JOIN roles ON usuarios.IdRol = roles.ID_Rol
        WHERE usuarios.estado_usuario = $estado";
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
                    $('#empleadosTable').DataTable();
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

<body>

    

        <!-- TABLA DE USUARIOS -->
        <div class="container">
    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
                <i class="fas fa-user-plus"></i> Agregar
            </button>
            <h3 class="text-center flex-grow-1">Lista de usuarios</h3>
            <div>
                <label for="filtroEstado" class="me-2">Filtrar:</label>
                <select id="filtroEstado" class="form-select d-inline-block w-auto">
                    <option value="1" <?= $estado == 1 ? 'selected' : '' ?>>Activos</option>
                    <option value="0" <?= $estado == 0 ? 'selected' : '' ?>>Dados de Baja</option>
                </select>
            </div>
        </div>

        <table id="empleadosTable" class="display text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Contraseña</th>
                    <th>Cargo</th>
                    <th>Avatar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['ID_Usuario'] ?></td>
                        <td><?= $row['Nombre_Usuario'] ?></td>
                        <td><?= $row['Email'] ?></td>
                        <td><?= $row['Contraseña'] ?></td>
                        <td><?= $row['Nombre_Rol'] ?></td>
                        <td class='avatar-column'><img src='uploads/<?= $row['Imagen'] ?>' alt='Avatar'></td>
                        <td class='btn-actions'>
                            <?php if ($row['estado_usuario'] == 1) { ?>
                                <button class='btn btn-success VerUsuarioBtn' data-bs-toggle='modal' data-bs-target='#modalVerUsuario' data-id='<?= $row['ID_Usuario'] ?>'>
                                    <i class='fas fa-eye'></i>
                                </button>
                                <a href='' class='btn btn-warning editarUsuarioBtn' data-bs-toggle='modal' data-bs-target='#modalEditarUsuario' data-id='<?= $row['ID_Usuario'] ?>'>
                                    <i class='fas fa-edit'></i>
                                </a>
                                <button class='btn btn-danger bajaUsuarioBtn' data-id='<?= $row['ID_Usuario'] ?>'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                            <?php } else { ?>
                                <button class='btn btn-success VerUsuarioBtn' data-bs-toggle='modal' data-bs-target='#modalVerUsuario' data-id='<?= $row['ID_Usuario'] ?>'>
                                    <i class='fas fa-eye'></i>
                                </button>
                                <button class='btn btn-primary reactivarUsuarioBtn' data-id='<?= $row['ID_Usuario'] ?>'>
                                    <i class='fas fa-user-check'></i>
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal para agregar usuario -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../pages/Ctrl/agregar_usuario.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required>
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="emailUsuario" id="emailUsuario" required>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="contraseñaUsuario" class="form-label">Contraseña</label>
                        <input type="" class="form-control" name="contraseñaUsuario" id="contraseñaUsuario" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="telefonoUsuario" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefonoUsuario" id="telefonoUsuario">
                    </div>

                    <!-- Rol -->
                    <div class="mb-3">
                        <label for="rolUsuario" class="form-label">Rol</label>
                        <select class="form-control" name="rolUsuario" id="rolUsuario" required>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                        </select>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label for="imagenUsuario" class="form-label">Imagen de Perfil</label>
                        <input type="file" class="form-control" name="imagenUsuario" id="imagenUsuario" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../pages/Ctrl/actualizar_usuario.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idUsuario" id="idUsuario"> <!-- Campo oculto -->

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre_Usuario" id="nombre_Usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="email_Usuario" id="email_Usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="contraseñaUsuario" class="form-label">Contraseña (Dejar vacío si no desea cambiarla)</label>
                        <input type="" class="form-control" name="contraseña_Usuario" id="contraseña_Usuario">
                    </div>

                    <div class="mb-3">
                        <label for="telefonoUsuario" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono_Usuario" id="telefono_Usuario">
                    </div>

                    <div class="mb-3">
                        <label for="rolUsuario" class="form-label">Rol</label>
                        <select class="form-control" name="rol_Usuario" id="rol_Usuario" required>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="imagenUsuario" class="form-label">Imagen de Perfil</label>
                        <input type="file" class="form-control" name="imagenUsuario" id="imagenUsuario" accept="image/*">
                        <img id="imagenPreview" src="" alt="Vista previa" style="max-width: 100px; display: none;">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver Usuario -->
<div class="modal fade" id="modalVerUsuario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Datos del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idUsuario" id="idUsuario"> <!-- Campo oculto -->

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre_Usuario" id="nombre_Usuario" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="email_Usuario" id="email_Usuario" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="contraseñaUsuario" class="form-label">Contraseña</label>
                        <input type="" class="form-control" name="contraseña_Usuario" id="contraseña_Usuario" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="telefonoUsuario" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono_Usuario" id="telefono_Usuario" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="rolUsuario" class="form-label">Rol</label>
                        <select class="form-control" name="rol_Usuario" id="rol_Usuario" disabled>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="imagenUsuario" class="form-label">Imagen de Perfil</label>
                        <input type="file" class="form-control" name="imagenUsuario" id="imagenUsuario" accept="image/*" disabled>
                        <img id="imagenPreview" src="" alt="Vista previa" style="max-width: 100px; display: block;">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
// Cerrar la conexión
$conn->close();
?>
            
           <!-- <div class="contenedor">
                 <img src="../../dist/assets/img/logologin2.png" alt="Logo">
            </div>-->
  
<script src="../js/editar_usuario.js?2345"></script>
<script src="../js/Ver_usuario.js?1234"></script>
<script src="../js/mostar_filtro.js?1234"></script>
<script src="../js/baja_usuario.js?1234"></script>
<script src="../js/reactivar_usuario.js?1234"></script>

<?php

include_once "Ctrl/footer.php";
?>