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
                        <h3 class="mb-0">PRODUCTOS</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Productos</a></li>
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
                $('#productosTable').DataTable();
            });
        </script>


<!-- TABLA PRODUCTOS-->
<div class="container mt-4">
    <table id="productosTable" class="table table-striped text-center">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Existencia</th>
                <th>Dosis</th>
                <th>Presentación</th>
                <th>Fecha Vencimiento</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se llenarán los datos de los productos con PHP -->
            <?php
            include 'Cnx/conexion.php';
            // Consultar todos los productos (medicamentos)
            $sql = "SELECT * FROM medicamento";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_Medicamento'] . "</td>";
                    echo "<td>" . $row['Nombre_Medicamento'] . "</td>";
                    echo "<td><img src='" . $row['Imagen'] . "' class='img-thumbnail' width='50' height='50'></td>";
                    echo "<td>" . $row['N_Existencia'] . "</td>";
                    echo "<td>" . $row['Dosis'] . "</td>"; 
                    echo "<td>" . $row['Presentacion'] . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($row['Fecha_Vencimiento'])) . "</td>";
                    echo "<td>
                            <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#modalVerProducto' data-id='" . $row['ID_Medicamento'] . "' title='Ver Detalles'>
                                <i class='fas fa-eye'></i>
                            </button>
                          </td>";
                    echo "<td>
                            <a href='#' class='btn btn-warning btn-sm text-white' data-bs-toggle='modal' data-bs-target='#modalEditarProducto' data-id='" . $row['ID_Medicamento'] . "' title='Editar'>
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
                echo "<tr><td colspan='10'>No se encontraron productos</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>



        <?php

        include_once "Ctrl/footer.php";
        ?>