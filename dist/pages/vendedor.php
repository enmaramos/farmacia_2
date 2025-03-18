<?php
include_once "Ctrl/head.php";
?>

<?php
include('../pages/Cnx/conexion.php');

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


<!-- TABLA DE VENDEDORES -->
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
                    <th>ID</th> <!-- Agregado campo ID -->
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <!-- Mostrar ID -->
                        <td><?= $row['ID_Vendedor'] ?></td>
                        <!-- Mostrar solo el primer nombre y primer apellido -->
                        <td><?= explode(' ', $row['Nombre'])[0] . ' ' . explode(' ', $row['Apellido'])[0] ?></td>
                        <!-- Agregar el prefijo (+505) al número de teléfono -->
                        <td>(+505) <?= $row['Telefono'] ?></td>
                        <td><?= $row['Email'] ?></td>
                        <td>
                            <?php
                            // Mostrar el rol del vendedor
                            if ($row['ID_Rol'] == 1) {
                                echo "Administrador";
                            } else {
                                echo "Vendedor";
                            }
                            ?>
                        </td>
                        <td class='btn-actions'>
                            <!-- Botones de acción -->
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
<div class="modal fade" id="modalAgregarVendedor" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
                        <input type="text" class="form-control" name="nombreVendedor" id="nombreVendedor" placeholder="Ingrese el nombre completo" required>
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label for="apellidoVendedor" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellidoVendedor" id="apellidoVendedor" placeholder="Ingrese el apellido completo" required>
                    </div>

                    <!-- Número de Cédula -->
                    <div class="mb-3">
                        <label for="cedulaVendedor" class="form-label">N° Cédula</label>
                        <input type="text" class="form-control" name="cedulaVendedor" id="cedulaVendedor" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="telefonoVendedor" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefonoVendedor" id="telefonoVendedor" placeholder="(+505) 1234-5678" required>
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
                            <option value="H">Masculino</option>
                            <option value="M">Femenino</option>
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="emailVendedor" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="emailVendedor" id="emailVendedor" required>
                    </div>

                    <!-- Rol -->
                    <div class="mb-3">
                        <label for="rolVendedor" class="form-label">Rol</label>
                        <select class="form-control" name="rolVendedor" id="rolVendedor" required>
                            <option value="2">Empleado</option>
                            <option value="1">Administrador</option>
                        </select>
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

<!-- Validaciones de los Modales -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let modal = document.getElementById("modalAgregarVendedor");
    let formulario = modal.querySelector("form");

    // Resetear formulario al cerrar el modal con la "X" o el botón Cancelar
    modal.addEventListener("hidden.bs.modal", function () {
        formulario.reset();
    });

    let btnCancelar = modal.querySelector(".btn-secondary");
    if (btnCancelar) {
        btnCancelar.addEventListener("click", function() {
            formulario.reset();
        });
    }

    // Validación del campo teléfono
    const telefonoInput = document.getElementById("telefonoVendedor");

    // Establecer el valor inicial con el prefijo
    telefonoInput.value = "(+505) ";

    telefonoInput.addEventListener("input", function(event) {
        let valor = telefonoInput.value;

        // Asegurar que el prefijo siempre esté presente
        if (!valor.startsWith("(+505) ")) {
            telefonoInput.value = "(+505) ";
            return;
        }

        // Obtener solo los números después del prefijo
        let numeros = valor.replace(/\D/g, "").substring(3); // Removemos todo excepto números y evitamos modificar el prefijo (+505)

        // Limitar a 8 caracteres después del prefijo
        if (numeros.length > 8) {
            numeros = numeros.slice(0, 8);
        }

        // Formatear el número con guion después de los primeros 4 dígitos
        let telefonoFormateado = "(+505) ";
        if (numeros.length > 4) {
            telefonoFormateado += numeros.slice(0, 4) + "-" + numeros.slice(4);
        } else {
            telefonoFormateado += numeros;
        }

        // Asignar el valor formateado
        telefonoInput.value = telefonoFormateado;
    });

    // Evitar que el usuario borre el prefijo (+505)
    telefonoInput.addEventListener("keydown", function(event) {
        if (telefonoInput.selectionStart < 7 && (event.key === "Backspace" || event.key === "Delete")) {
            event.preventDefault(); // Evita que se borre el prefijo
        }
    });

    // Restaurar el prefijo si el usuario borra todo
    telefonoInput.addEventListener("blur", function() {
        if (telefonoInput.value.trim() === "" || telefonoInput.value === "(+505)") {
            telefonoInput.value = "(+505) ";
        }
    });

    // Verificar si el modal debe abrirse después de un error
    if (sessionStorage.getItem("modalOpen") === "true") {
        var modalBootstrap = new bootstrap.Modal(modal);
        modalBootstrap.show();
        sessionStorage.removeItem("modalOpen"); // Limpiar el estado para futuros intentos
    }
});
</script>









        <!-- Modal para editar vendedor -->
        <div class="modal fade" id="modalEditarVendedor" tabindex="-1" aria-labelledby="modalLabelEditar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelEditar">Editar Vendedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formEditarVendedor">
                        <div class="modal-body">
                            <input type="hidden" name="idVendedor" id="idVendedor">

                            <div class="mb-3">
                                <label for="editarNombreVendedor" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="editarNombreVendedor" id="editarNombreVendedor" required>
                            </div>

                            <div class="mb-3">
                                <label for="editarCedulaVendedor" class="form-label">N° Cédula</label>
                                <input type="text" class="form-control" name="editarCedulaVendedor" id="editarCedulaVendedor" required>
                            </div>

                            <div class="mb-3">
                                <label for="editarTelefonoVendedor" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="editarTelefonoVendedor" id="editarTelefonoVendedor">
                            </div>

                            <div class="mb-3">
                                <label for="editarDireccionVendedor" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="editarDireccionVendedor" id="editarDireccionVendedor">
                            </div>

                            <div class="mb-3">
                                <label for="editarSexoVendedor" class="form-label">Sexo</label>
                                <select class="form-control" name="editarSexoVendedor" id="editarSexoVendedor" required>
                                    <option value="H">Hombre</option>
                                    <option value="M">Mujer</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="editarEmailVendedor" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="editarCorreoVendedor" id="editarCorreoVendedor" required>
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





        <script src="../js/editar_vendedor.js?12345"></script>

        <?php
        $conn->close();
        ?>





        <?php

        include_once "Ctrl/footer.php";
        ?>