<?php
include_once "Ctrl/head.php";
?>

<?php
include ('../pages/Cnx/conexion.php');

$query = "SELECT * FROM vendedor";
$result = $conn->query($query);

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
                        <h3 class="mb-0">Vendedores</h3>
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
                $('#vendedoresTable').DataTable();
            });
        </script>

<div class="container">
    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarVendedor">
                <i class="fas fa-user-plus"></i> Agregar
            </button>
            <h3 class="text-center flex-grow-1">Lista de Vendedores</h3>
        </div>

        <table id="vendedoresTable" class="display text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>N° Cédula</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Sexo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['ID_Vendedor'] ?></td>
                        <td><?= $row['Nombre'] ?></td>
                        <td><?= $row['N_Cedula'] ?></td>
                        <td><?= $row['Telefono'] ?></td>
                        <td><?= $row['Direccion'] ?></td>
                        <td><?= $row['Sexo'] == 'H' ? 'Hombre' : 'Mujer' ?></td>
                        <td class='btn-actions'>
                            <button class='btn btn-success VerVendedorBtn' data-bs-toggle='modal' data-bs-target='#modalVerVendedor' data-id='<?= $row['ID_Vendedor'] ?>'>
                                <i class='fas fa-eye'></i>
                            </button>
                            <a href='' class='btn btn-warning editarVendedorBtn' data-bs-toggle='modal' data-bs-target='#modalEditarVendedor' data-id='<?= $row['ID_Vendedor'] ?>'>
                                <i class='fas fa-edit'></i>
                            </a>
                            <button class='btn btn-danger eliminarVendedorBtn' data-id='<?= $row['ID_Vendedor'] ?>'>
                                <i class='fas fa-trash-alt'></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Modal para agregar vendedor -->
<div class="modal fade" id="modalAgregarVendedor" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Agregar Vendedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../pages/Ctrl/agregar_vendedor.php" method="POST">
                <div class="modal-body">
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombreVendedor" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombreVendedor" id="nombreVendedor" required>
                    </div>

                    <!-- Número de Cédula -->
                    <div class="mb-3">
                        <label for="cedulaVendedor" class="form-label">N° Cédula</label>
                        <input type="text" class="form-control" name="cedulaVendedor" id="cedulaVendedor" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="telefonoVendedor" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefonoVendedor" id="telefonoVendedor">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="direccionVendedor" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccionVendedor" id="direccionVendedor">
                    </div>

                    <!-- Sexo -->
                    <div class="mb-3">
                        <label for="sexoVendedor" class="form-label">Sexo</label>
                        <select class="form-control" name="sexoVendedor" id="sexoVendedor" required>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                        </select>
                    </div>

                    <!-- Email (Correo) -->
                    <div class="mb-3">
                        <label for="emailVendedor" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="emailVendedor" id="emailVendedor" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Vendedor</button>
                </div>
            </form>
        </div>
    </div>
</div>





<?php
$conn->close();
?>





        <?php

        include_once "Ctrl/footer.php";
        ?>