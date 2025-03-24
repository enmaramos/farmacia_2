<?php
include_once "Ctrl/head.php";
?>

<?php
include('../pages/Cnx/conexion.php');

$query = "SELECT * FROM categoria";
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
                        <!-- <h3 class="mb-0">Vendedores</h3> -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Categorias</a></li>
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
                $('#categoriaTable').DataTable();
            });
        </script>


        <!-- TABLA DE Categoria -->
        <div class="container">
            <div class="card p-3 shadow-sm">
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
                        <i class="fas fa-user-plus"></i> Agregar
                    </button>
                    <h3 class="text-center flex-grow-1">Lista de Categorias</h3>
                </div>

                <table id="categoriaTable" class="display text-center">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Ver</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td> <?= $row['ID_Categoria'] ?></td>
                                <td><?= $row['Nombre_Categoria'] ?></td>
                                <td><?= $row['Descripcion'] ?></td>
                                <td>
                                    <button class='btn btn-success VerCategoriaBtn btn-sm' data-bs-toggle='modal' data-bs-target='#modalVerCategoria' data-id='<?= $row['ID_Categoria'] ?>' title="Ver Detalles">
                                        <i class='fas fa-eye'></i>
                                    </button>
                                </td>
                                <td>
                                    <a href='' class='btn btn-warning editarCategoriaBtn btn-sm ' data-bs-toggle='modal' data-bs-target='#modalEditarCategoria' data-id='<?= $row['ID_Categoria'] ?>' title="Editar Categoria">
                                        <i class='fas fa-edit'></i>
                                    </a>
                                </td>
                                <td>
                                    <button class='btn btn-danger eliminarCategoriaBtn btn-sm' data-id='<?= $row['ID_Categoria'] ?>' title="Eliminar Categoria">
                                        <i class='fas fa-trash-alt'></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal para agregar categoria -->
        <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../pages/Ctrl/agregar_categoria.php" method="POST">
                        <div class="modal-body">
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombreCategoria" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreCategoria" id="nombreCategoria" placeholder="Ingrese el nombre completo" required>
                            </div>

                            <!-- Descripcion -->
                            <div class="mb-3">
                                <label for="Descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="Descripcion" id="Descripcion" placeholder="Ingrese la Descripcion de la Categoria" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Categoria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Validaciones de los Modales -->
<script>
document.addEventListener("DOMContentLoaded", function() { 
    let modal = document.getElementById("modalAgregarCategoria"); 
    let formulario = modal.querySelector("form");

    // Resetear formulario al cerrar el modal con la "X" o el botón Cancelar
    modal.addEventListener("hidden.bs.modal", function() { 
        formulario.reset(); 
    });

    let btnCancelar = modal.querySelector(".btn-secundario"); 
    if (btnCancelar) { 
        btnCancelar.addEventListener("click", function() { 
            formulario.reset(); 
        }); 
    }

    // Evitar caracteres incorrectos al escribir
    cedulaInput.addEventListener("keydown", function(event) {
        let valor = cedulaInput.value;

        // Permitir Backspace, Delete y teclas de navegación
        if (["Backspace", "Delete", "ArrowLeft", "ArrowRight", "Tab"].includes(event.key)) {
            return;
        }

        // No permitir más de 16 caracteres
        if (valor.length >= 16) {
            event.preventDefault();
            return;
        }

        // Evitar letras antes de los números
        if (valor.length === 0 && event.key.match(/[A-Za-z]/)) {
            event.preventDefault();
        }

        // Evitar números en la última posición
        if (valor.length === 15 && event.key.match(/\d/)) {
            event.preventDefault();
        }
    });

    // Verificar si el modal debe abrirse después de un error
    if (sessionStorage.getItem("modalOpen") === "true") { 
        var modalBootstrap = new bootstrap.Modal(modal); 
        modalBootstrap.show(); 
        sessionStorage.removeItem("modalOpen"); 
    }
});
</script>


    <!-- Modal para editar Categoria -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalLabelEditar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelEditar">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarCategoria">
                <div class="modal-body">
                    <input type="hidden" name="idCategoria" id="idCategoria">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="editarNombreCategoria" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="editarNombreCategoria" id="editarNombreCategoria" required>
                    </div>

                    <!-- Descripcion -->
                    <div class="mb-3">
                        <label for="editarDescripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" name="editarDescripcion" id="editarDescripcion" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para ver categoria -->
<div class="modal fade" id="modalVerCategoria" tabindex="-1" aria-labelledby="modalVerCategoriaLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerCategoriaLabel">Ver Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombreCategoriaVer" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreCategoriaVer" disabled>
                </div>

                <!-- Descripcion -->
                <div class="mb-3">
                    <label for="DescripcionVer" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="DescripcionVer" disabled>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




        <script src="../js/editar_categoria.js?123456"></script>
        <script src="../js/baja_vendedor.js?12345"></script>
        <script src="../js/ver_categoria.js?12345"></script>

        <?php
        $conn->close();
        ?>





        <?php

        include_once "Ctrl/footer.php";
        ?>